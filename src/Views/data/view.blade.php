<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @if ($errors->all())
                <div class="alert alert-danger">
                    <p>The following {{ str_plural('error', $errors->count()) }} occurred: </p>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Prepare to run {{ $command }}</h3>
                </div>
                <div class="panel-body">
                    {!! Form::open(array('route' => ['midnite81.artisan.execute', $command], 'class' => 'form form-inline')) !!}

                    <table class="table table-striped" style="margin-bottom: 0;">
                        <thead>
                        <tr>
                            <th style="width: 30%">Key</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($commandClass->getDefinition()->getArguments() as $key=>$argument)
                            <tr>
                                <td>
                                    {{ ucwords($key) }}
                                    @if($argument->isRequired())*@endif
                                </td>
                                <td>
                                    <input type="text" name="arguments[{{ $key }}]" id="arguments-{{ $key }}"
                                           value="{{ $argument->getDefault() }}" style="width: 400px">
                                    <label style="font-weight: normal; color: #b3b0b3"><input type="checkbox" name="arguments[{{ $key }}_null]" value="1"> <em>null</em></label>
                                </td>
                            </tr>
                        @endforeach
                        @foreach($commandClass->getDefinition()->getOptions() as $key=>$option)
                            <tr>
                                <td>
                                    {{ ucwords($key) }}
                                </td>
                                <td>
                                    <input type="checkbox"
                                           name="options[{{ $key }}]"
                                           value="{{ $key }}"
                                           @if (! config('laracommander.autocomplete', true)) autocomplete="off" @endif
                                    >
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2" class="text-right">
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button class="btn btn-info">Run Command</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>