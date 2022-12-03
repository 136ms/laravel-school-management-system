<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="subjects-table">
            <thead>
            <tr>
                <th>Subject ID</th>
                <th>Subject name</th>
                <th colspan="3">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}.</td>
                    <td>{{ $subject->subject_name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['subjects.destroy', $subject->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('subjects.show', [$subject->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('subjects.edit', [$subject->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $subjects])
        </div>
    </div>
</div>
