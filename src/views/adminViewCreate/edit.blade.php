<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Report</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <script type="module" src="{{ asset('js/columnNameFetcher.mjs') }}" defer></script>
    <script type="module" src="{{ asset('js/tableDataViewer.mjs') }}" defer></script>
    <script type="module" src="{{ asset('js/tableDataFetcher.mjs') }}" defer></script>
    {{-- <script type="module" src="{{ asset('js/joinedDataFetcher.mjs') }}" defer></script> --}}
    <script type="module" src="{{ asset('js/addTables.mjs') }}" defer></script>
    {{-- <script type="module" src="{{ asset('js/editReport.mjs') }}" defer></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="{{ asset('modules/prism.min.css') }}"> --}}
    <script src="{{ asset('modules/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('modules/jquery.slim.min.js') }}"></script> --}}
    <script src="{{ asset('modules/bootstrap.min.js') }}"></script>
    <script src="{{ asset('modules/bootstrap2.min.js') }}"></script>
    {{-- <script src="{{ asset('modules/alpine.min.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('modules/popper.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('modules/prism-json.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('modules/prism.js') }}"></script> --}}
    {{-- <script src="{{ asset('modules/prism.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('modules/cdn.min.js') }}"></script> --}}
    <link rel="stylesheet" href="{{ asset('modules/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('modules/bootstrap2.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('modules/bootstrap3.min.css') }}"> --}}
    @routes
    <style>
        body {
            background-color: #ffffff;
        }

        .container-bg {
            background-color: #f5f2f0;
            padding: 20px;
            border-radius: 10px;
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }



        .form-group {
            margin-bottom: 20px;
        }

        #addTableDiv {
            text-align: right;
        }

        #addTable {
            font-size: 1.5em;
        }

        .center-button {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .shadow-line {
            box-shadow: 0px 4px 5px -2px rgba(0, 0, 0, 0.75);
        }

        .close-button {
            position: relative;
        }

        .close-button .close {
            position: absolute;
            top: -5px;
            right: 10px;
            z-index: 1;
            background: none;
            border: none;
            color: black;
            padding: 0;
            font-size: 1.5rem;
            font-weight: 300;
        }
    </style>
</head>

<body>
    <div class="container center-button">
        <div class="container-bg row">
            <h1 class="mb-4">Update Report</h1>
            <form action="{{ url('view-report/' . $id . '/edit') }}" method="post">
                @csrf
                <div class="shadow-line p-3 mb-5 rounded">
                    <div>
                        <input type="text" name="name" class="form-control mt-4" id="reportName"
                            value="{{ $name }}" required></input>
                    </div>
                    <div>
                        <select name="users[]" id="users" class="form-select mt-4 mb-4" multiple>
                            <option disabled value="">Select Users</option>
                            @foreach ($users as $user)
                                <option value="{{ $user }}"
                                    {{ in_array($user, $selectedUsers) ? 'selected' : '' }}>
                                    {{ $user }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="tablesDiv" class="mb-4">
                    @foreach ($report_details->tables as $index => $tables)
                        @foreach ($tables as $table => $columns)
                            <div id="dynamicDiv{{ $index }}"
                                class="tables shadow-line close-button p-3 mb-5 rounded">
                                <div class="g-3">
                                    <label for="table{{ $index }}" class="form-label"></label>
                                    <select name="table[]" id="table{{ $index }}" class="form-select dynamic"
                                        data-dependent="tableColumns{{ $index }}"
                                        dependent="tableColumns{{ $index }}" required>
                                        <option disabled selected value="">Select Table</option>
                                        @foreach ($tableNames as $tableName)
                                            <option value="{{ $tableName }}"
                                                {{ $tableName == $table ? 'selected' : '' }}>{{ $tableName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- @php
                                    dd($view->tables);
                                @endphp --}}
                                    <label for="tableColumns{{ $index }}" class="form-label"></label>
                                    <select name="tables[{{ $index }}][{{ $table }}][]"
                                        id="tableColumns{{ $index }}"
                                        class="form-select mt-0 mb-4 dynamicdatas tableColumnChanged"
                                        data-dependent="tableDatas{{ $index }}" required multiple>
                                        @foreach ($selectedTables[$table] as $column)
                                            <option value="{{ $column }}"
                                                {{ in_array($column, $columns) ? 'selected' : '' }}>
                                                {{ $column }}
                                            </option>
                                            {{-- <option value="{{ $column }}">{{ $column }}</option> --}}
                                        @endforeach
                                    </select>
                                </div>
                                @if ($index !== 0)
                                    <button type="button" id="customCloseButton{{ $index }}" class="close"
                                        aria-label="Close">
                                        <span class="close-wrapper">
                                            <span class="close" aria-hidden="true">&times;</span>
                                            <!-- Cross inside a wrapper -->
                                        </span>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                        @if ($index !== 0)
                            <script type="module">
                                import {
                                    incrementnumberOfTables
                                } from "{{ asset('js/addTables.mjs') }}";
                                document.addEventListener("DOMContentLoaded", function() {
                                    incrementnumberOfTables();
                                });
                            </script>
                            <div id="joinOnDiv{{ $index }}">
                                <select id="tablesJoin{{ $index }}"
                                    name="joins[{{ $index - 1 }}][join_type]"
                                    class="form-select mt-4 dynamicdatas joins"
                                    dependent1="leftTable{{ $index }}"
                                    dependent2="rightTable{{ $index }}" style="margin-bottom: 20px;" required>
                                    <option value="" disabled="">Select Join Type</option>
                                    <option value="inner"
                                        {{ $report_details->joins[$index - 1]->join_type === 'inner' ? 'selected' : '' }}>
                                        Inner
                                        Join</option>
                                    <option value="left"
                                        {{ $report_details->joins[$index - 1]->join_type === 'left' ? 'selected' : '' }}>
                                        Left
                                        Join</option>
                                    <option value="right"
                                        {{ $report_details->joins[$index - 1]->join_type === 'right' ? 'selected' : '' }}>
                                        Right
                                        Join</option>
                                    <option value="cross"
                                        {{ $report_details->joins[$index - 1]->join_type === 'cross' ? 'selected' : '' }}>
                                        Cross
                                        Join</option>
                                </select>
                                <div class="d-flex flex-row">
                                    <div class="flex-grow-1">
                                        <select id="leftTable{{ $index }}"
                                            name="joins[{{ $index - 1 }}][left_table]"
                                            class="form-select dynamicdatas jointablenames leftTablesJoin"
                                            dependent="joinOnDiv{{ $index }}"
                                            data-dependent="leftTableColumn{{ $index }}"
                                            style="{{ $report_details->joins[$index - 1]->join_type === 'cross' ? 'display: none;' : 'display: block; margin-bottom: 20px;' }}"
                                            {{ $report_details->joins[$index - 1]->join_type !== 'cross' ? 'required' : '' }}>
                                            <option value="" disabled="">Select Join Table</option>
                                            @if ($report_details->joins[$index - 1]->join_type !== 'cross')
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($report_details->tables as $tables)
                                                    @foreach ($tables as $table => $columns)
                                                        <option value="{{ $table }}"
                                                            {{ $report_details->joins[$index - 1]->left_table === $table ? 'selected' : '' }}>
                                                            {{ $table }}</option>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                    @php
                                                        if ($i == $index + 1) {
                                                            break;
                                                        }
                                                    @endphp
                                                @endforeach
                                            @endif
                                        </select>
                                        {{-- @for ($i = 0; $i <= $index; $i++)
                                            {{ $view['tables'][$i][$table][0] }}
                                        @endfor --}}
                                        <select name="joins[{{ $index - 1 }}][left_column]"
                                            id="leftTableColumn{{ $index }}"
                                            class="form-select joinTables leftTablesColumns"
                                            data-dependent="leftTable{{ $index }}"
                                            style="{{ $report_details->joins[$index - 1]->join_type === 'cross' ? 'display: none;' : 'display: block; margin-bottom: 20px;' }}"
                                            {{ $report_details->joins[$index - 1]->join_type !== 'cross' ? 'required' : '' }}>
                                            <option value="" disabled="">Select Join Column</option>
                                            @if ($report_details->joins[$index - 1]->join_type !== 'cross')
                                                @foreach ($selectedTables[$report_details->joins[$index - 1]->left_table] as $column)
                                                    <option value="{{ $column }}"
                                                        {{ $report_details->joins[$index - 1]->left_column === $column ? 'selected' : '' }}>
                                                        {{ $column }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="flex-grow-1">
                                        <select id="rightTable{{ $index }}"
                                            name="joins[{{ $index - 1 }}][right_table]"
                                            class="form-select dynamicdatas jointablenames rightTablesJoin"
                                            dependent="joinOnDiv{{ $index }}"
                                            data-dependent="rightTableColumn{{ $index }}"
                                            style="{{ $report_details->joins[$index - 1]->join_type === 'cross' ? 'display: none;' : 'display: block; margin-bottom: 20px;' }}"
                                            {{ $report_details->joins[$index - 1]->join_type !== 'cross' ? 'required' : '' }}>
                                            <option value="" disabled="">Select Join Table</option>
                                            @if ($report_details->joins[$index - 1]->join_type !== 'cross')
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($report_details->tables as $tables)
                                                    @foreach ($tables as $table => $columns)
                                                        <option value="{{ $table }}"
                                                            {{ $report_details->joins[$index - 1]->right_table === $table ? 'selected' : '' }}>
                                                            {{ $table }}</option>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach
                                                    @php
                                                        if ($i == $index + 1) {
                                                            break;
                                                        }
                                                    @endphp
                                                @endforeach
                                            @endif
                                        </select>
                                        <select name="joins[{{ $index - 1 }}][right_column]"
                                            id="rightTableColumn{{ $index }}"
                                            class="form-select joinTables rightTablesColumns"
                                            style="{{ $report_details->joins[$index - 1]->join_type === 'cross' ? 'display: none;' : 'display: block; margin-bottom: 20px;' }}"
                                            {{ $report_details->joins[$index - 1]->join_type !== 'cross' ? 'required' : '' }}>
                                            <option value="" disabled="">Select Join Column</option>
                                            @if ($report_details->joins[$index - 1]->join_type !== 'cross')
                                                @foreach ($selectedTables[$report_details->joins[$index - 1]->right_table] as $column)
                                                    <option value="{{ $column }}"
                                                        {{ $report_details->joins[$index - 1]->right_column === $column ? 'selected' : '' }}>
                                                        {{ $column }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div id="addTableDiv" class="mt-3" type="button">
                    <button id="addTable" class="btn btn-secondary px-2 py-0"> + </button>
                </div>
                <div class="center-button mt-4">
                    <button type="submit" class="btn btn-info text-white px-2">Update</button>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</body>

</html>