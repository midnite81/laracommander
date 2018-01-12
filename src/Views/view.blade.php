@extends('artisan-dashboard::layouts.main')

@section('title', 'Console')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                @if(session('console.result'))
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Response from {{ session('console.name') }}:</strong><br>
                        {{ trim(session('console.result')) }}
                    </div>
                @endif

                <table class="table table-stripped">
                    <thead>
                    <tr>
                        <th>Command</th>
                        <th>Arguments</th>
                        <th>Options</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    @foreach($commands as $commandName=>$command)
                        @if(str_contains(get_class($command), ['App\\', 'Midnite81\\'])
                            && ! property_exists($command, 'dontShow'))
                            <tr>
                                <td>
                                    {{ $command->getName() }}
                                    <em style="color: #adadad">{{ $command->getDescription() }}</em>
                                </td>
                                <td>
                                    {{ count($command->getDefinition()->getArguments()) }}
                                </td>
                                <td>
                                    {{ count($command->getDefinition()->getOptions()) }}
                                </td>
                                <td>
                                    <a href="{{ route('midnite81.artisan.view', [$command->getName()]) }}"
                                       class="btn  btn-xs @if(empty($command->getDefinition()->getArguments())
                                   && empty($command->getDefinition()->getOptions())) btn-danger
                                    @else btn-info @endif">Run {{ $command->getName() }}</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

@endsection
