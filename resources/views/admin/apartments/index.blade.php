@extends('layouts.admin')

@section('content')

<h1 class="text-center">I MIEI APPARTMAMENTI - INDEX</h1>

<div class="container-fluid bg-light py-3">
    <!-- <h5>Add new Project</h5> -->
    <a href="{{route('admin.apartments.create')}}"><i class="fa-solid fa-plus fa-2x"></i></a>
    <!-- INSERIRE BOTTONE PER AGGIUNGERE APARTMENTS -->

    <table class="table table-striped m-0 py-5">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">Preview image</th>
                <th scope="col">n_stanze</th>
                <th scope="col">n_bagni</th>
                <th scope="col">n_letti</th>
                <th scope="col">mq</th>
                <th scope="col">indirizzo</th>
                <th scope="col">Visibile</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($apartments as $project)
            <tr>
                <td scope="row">{{$project->id}}</td>
                <td scope="row">{{$project->title}}</td>
                <td class="text-center">
                    <img class="img-fluid" style="height: 100px; width:160px; object-fit:cover;" src="" alt="{{$apartment->title}}" loading="lazy">
                    <!--  src="{{asset('storage/'. $apartment->img_path)}}"-->
                </td>
                <td>{{$project->n_stanze}}</td>
                <td>{{$project->n_bagni}}</td>
                <td>{{$project->n_letti}}</td>
                <td>{{$project->mq}}</td>
                <td>{{$project->indirizzo}}</td>
                <td>{{$project->Visibile}}</td>
                <td>
                    SHOW/EDIT/DELETE
                    <!--                     
                    <a href="{{route('admin.apartments.show', $apartment->slug)}}"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('admin.apartments.edit', $apartment->slug)}}"><i class="fa-solid fa-pencil"></i></a>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                        <i class="fa-solid fa-trash-can" style="color: #dc3545"></i>
                    </button> -->


                    <!-- Modal -->
                    <!--                     <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalTitleId">Delete "{{$apartment->title}}" apartment?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete this apartment?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('admin.apartments.destroy', $apartment)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Confirm</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div> -->

                </td>
            </tr>

            @empty
            <p>No apartments yet</p>
        </tbody>
        @endforelse

    </table>


    @endsection