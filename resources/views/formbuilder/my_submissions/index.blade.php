@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">
                      ({{ $submissions->count() }})

                        <a href="" class="btn btn-primary float-md-right btn-sm" title="Back To My Forms">
                            <i class="fa fa-th-list"></i> My Forms
                        </a>
                    </h5>
                </div>

                @if($submissions->count())
                    <div class="table-responsive">
                        <table class="table table-bordered d-table table-striped pb-0 mb-0">
                            <thead>
                                <tr>
                                    <th class="five">#</th>
                                    <th class="">Form</th>
                                   <th class="twenty-five">Updated On</th>
                                    <th class="twenty-five">Created On</th>
                                    <th class="fifteen">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $submission)
                                    <tr>
                                        <td>{{ $loop->iteration }} </td> 
                                        <td>{{ $submission->name}}</td>
                                        <td>{{ $submission->updated_at }}</td>
                                        <td> {{ $submission->created_at }}  </td>
                                        
                                        <td>
                                            <a href="{{ route('form.show', [$submission->id]) }}" class="btn btn-primary btn-sm" title="View submission">
                                                <i class="fa fa-eye"></i> 
                                            </a> 
                                            <a href="{{ route('form.edit', [$submission->id]) }}" class="btn btn-primary btn-sm" title="View submission">
                                                <i class="fas fa-edit"></i> 
                                            </a> 
                                            <a href="{{ route('form.historic', [$submission->id]) }}" class="btn btn-primary btn-sm" title="View submission">
                                                <i class="fa fa-history"></i> 
                                            </a> 

                                          

                                            {{-- <form action="{{ route('formbuilder::my-submissions.destroy', [$submission]) }}" method="POST" id="deleteSubmissionForm_{{ $submission->id }}" class="d-inline-block">
                                                @csrf 
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteSubmissionForm_{{ $submission->id }}" data-message="Delete this submission?" title="Delete submission">
                                                    <i class="fa fa-trash-o"></i> 
                                                </button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                   @endif
            </div>
        </div>
    </div>
</div>
@endsection
