@extends('layouts.adminLTE')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Fasilitas {{ $fasilita->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/fasilitas') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/fasilitas/' . $fasilita->id . '/edit') }}" title="Edit Fasilita"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/fasilitas' . '/' . $fasilita->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Fasilita" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $fasilita->id }}</td>
                                    </tr>
                                    <tr><th> Nama </th><td> {{ $fasilita->nama }} </td></tr><tr><th> Artikel </th><td> {{ $fasilita->artikel }} </td></tr><tr><th> Galeri </th><td><img src='\image\{{ $fasilita->galeri }}' width='500px'> </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
