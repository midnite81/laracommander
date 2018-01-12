<?php

namespace Midnite81\ArtisanDashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory;

class ConsoleController
{
    /**
     * @var Kernel
     */
    protected $artisan;
    /**
     * ConsoleController constructor.
     */
    public function __construct()
    {
        $this->artisan = app(config('artisan-dashboard.class', '\App\Console\Kernel::class'));
    }
    /**
     * Show all commands
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $commands = $this->artisan->all();
        ksort($commands);
        return view('artisan-dashboard::index', compact('commands'));
    }
    /**
     * View command
     *
     * @param $command
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($command)
    {
        $commandClass = $this->artisan->all()[$command];
        if (empty($commandClass->getDefinition()->getArguments())
            && empty($commandClass->getDefinition()->getOptions())) {
            $request = $this->artisan->call($command);
            $response = $this->artisan->output();
            return redirect()->route('midnite81.artisan.dashboard')->with('console.result', $response)->with('console.name', $command);
        }
        return view('artisan-dashboard::view', compact('command', 'commandClass'));
    }
    /**
     * @param Request $request
     * @param Factory|Validator $validator
     * @param $command
     * @return $this
     */
    public function execute(Request $request, Factory $validator, $command)
    {
        $commandClass = $this->artisan->all()[$command];
        $rules = $this->getCommandRules($commandClass);
        if (! empty($rules)) {
            $validate = $validator->make($request->all(), $rules);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
        }
        $args = $this->prepareArgumentsAndOptions($request);
        $this->artisan->call($command, $args);
        $response = $this->artisan->output();
        return redirect()->route('midnite81.artisan.dashboard')->with('console.result', $response)->with('console.name', $command);
    }
    /**
     * Get command rules
     *
     * @param $commandClass
     * @return array
     */
    protected function getCommandRules($commandClass)
    {
        $rules = [];
        if ( ! empty($args = $commandClass->getDefinition()->getArguments())) {
            foreach ($args as $key => $arg) {
                if ($arg->isRequired()) {
                    $rules['arguments.'.$key] = 'required|min:1';
                }
            }
        }
        return $rules;
    }
    /**
     * Prepare the arguments and options for command
     * @param $data
     * @return array
     */
    protected function prepareArgumentsAndOptions($data)
    {
        $output = [];
        if ($data->has('arguments')) {
            foreach($data->get('arguments') as $key=>$arg) {
                $field = str_replace('_null', '', $key);
                $output[$field] = str_contains($key, '_null') ? null : $arg;
            }
        }
        if ($data->has('options')) {
            foreach($data->get('options') as $key=>$arg) {
                $opt = '--'.$key;
                $output[$opt] = $opt;
            }
        }
        return $output;
    }
}