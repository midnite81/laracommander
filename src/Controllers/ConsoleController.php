<?php

namespace Midnite81\LaraCommander\Controllers;

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
        $this->artisan = app(config('laracommander.class', '\App\Console\Kernel::class'));
        if (! empty(config('laracommander.runtime.memory'))) {
            ini_set('memory_limit', config('laracommander.runtime.memory'));
        }
        if (! is_null(config('laracommander.runtime.timeout'))) {
            ini_set('memory_limit', config('laracommander.runtime.timeout'));
        }
    }

    /**
     * Show all commands
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $commands = $this->getCommands();

        ksort($commands);
        return view($this->getView('index'), compact('commands'));
    }

    /**
     * View command
     *
     * @param $command
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($command)
    {
        $commandClass = isset($this->getCommands()[$command]) ? $this->getCommands()[$command] : null;

        if (empty($commandClass)) {
            abort(404);
        }

        if (empty($commandClass->getDefinition()->getArguments())
            && empty($commandClass->getDefinition()->getOptions())) {
            $request = $this->artisan->call($command);
            $response = $this->artisan->output();
            return redirect()->route('midnite81.artisan.dashboard')->with('console.result', $response)
                             ->with('console.name', $command);
        }
        return view($this->getView('view'), compact('command', 'commandClass'));
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
        if ( ! empty($rules)) {
            $validate = $validator->make($request->all(), $rules);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
        }
        $args = $this->prepareArgumentsAndOptions($request);
        $this->artisan->call($command, $args);
        $response = $this->artisan->output();
        return redirect()->route('midnite81.artisan.dashboard')->with('console.result', $response)
                         ->with('console.name', $command);
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
                    $rules['arguments.' . $key] = 'required|min:1';
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
            foreach ($data->get('arguments') as $key => $arg) {
                $field = str_replace('_null', '', $key);
                $output[$field] = str_contains($key, '_null') ? null : $arg;
            }
        }
        if ($data->has('options')) {
            foreach ($data->get('options') as $key => $arg) {
                $opt = '--' . $key;
                $output[$opt] = $opt;
            }
        }
        return $output;
    }

    /**
     * @return array
     */
    protected function getCommands()
    {
        $commands = array_filter($this->artisan->all(), function ($class) {

            if ($this->classIsShowable($class)) {
                return true;
            }

            if ($this->classIsHidden($class)) {
                return false;
            }

            if ( ! empty(config('laracommander.accepted-namespaces'))) {
                return $this->inAcceptedNamespace($class) && $this->classHasNoDontShowProperty($class);
            }
            return $this->classHasNoDontShowProperty($class);
        });
        return $commands;
    }

    /**
     * Get index view name
     *
     * @return string
     */
    protected function getView($page)
    {
        if (! empty(config('laracommander.views.' . $page))) {
            return config('laracommander.views.' . $page);
        }

        return 'laracommander::' . $page;
    }

    /**
     * Checks if class is showable
     *
     * @param $class
     * @return bool
     */
    protected function classIsShowable($class)
    {
        return in_array(get_class($class), config('laracommander.showable'));
    }

    /**
     * Checks if class is hidden
     *
     * @param $class
     * @return bool
     */
    protected function classIsHidden($class)
    {
        return in_array(get_class($class), config('laracommander.hidden'));
    }

    /**
     * Checks if class is in an accepted namespace
     *
     * @param $class
     * @return bool
     */
    protected function inAcceptedNamespace($class)
    {
        return str_contains(get_class($class), config('laracommander.accepted-namespaces'));
    }

    /**
     * Checks if class has dontShow set
     *
     * @param $class
     * @return bool
     */
    protected function classHasNoDontShowProperty($class)
    {
        return ! property_exists($class, 'dontShow');
    }
}