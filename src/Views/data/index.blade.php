<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @if(session('console.result'))
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Response from {{ session('console.name') }}:</strong><br>
                    <div style="font-family: Consolas, Menlo,Monaco,'Courier New',monospace; font-size: 12px; word-wrap: break-word;">
                        {!! nl2br(trim(session('console.result'))) !!}
                    </div>
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
                @if(! empty($commands))
                @foreach($commands as $commandName=>$command)
                        <tr>
                            <td>
                                <span title="{{ get_class($command) }}">{{ $command->getName() }}</span>
                                <em style="color: #adadad">{{ strip_tags($command->getDescription()) }}</em>
                            </td>
                            <td>
                                {{ count($command->getDefinition()->getArguments()) }}
                            </td>
                            <td>
                                {{ count($command->getDefinition()->getOptions()) }}
                            </td>
                            <td>
                                @if(empty($command->getDefinition()->getArguments())
                                   && empty($command->getDefinition()->getOptions()))
                                    <a onclick="let x = confirm('Are you sure you want to run {{ $command->getName() }}'); if (x) { window.location.href = '{{ route('midnite81.artisan.view', [$command->getName()]) }}' }"
                                       class="btn  btn-xs  btn-danger">Run {{ $command->getName() }}</a>
                                    @else
                                <a href="{{ route('midnite81.artisan.view', [$command->getName()]) }}"
                                   class="btn  btn-xs  btn-info">Run {{ $command->getName() }}</a>
                                    @endif
                            </td>
                        </tr>
                @endforeach
                    @else
                    <tr>
                        <td colspan="4">No commands are available</td>
                    </tr>
                    @endif
                </tfoot>
            </table>

        </div>
    </div>
</div>
