<x-layout title="Insecure Design">

    @auth

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <form class="p-5 border" method="POST" action="{{ route('image.store') }}" enctype="multipart/form-data">
                    @if (session('submitted'))
                        <div class="alert alert-success">
                            {{ session('submitted') }}
                        </div>
                    @endif

                    @csrf
                    <div class="mb-3">
                        <label for="image" class="form-label">Immagine da salvare</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>

                    <button type="submit" class="btn btn-primary">inserisci la tua immagine</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h2>Le tue immagini</h2>
            </div>
            @foreach($images as $image)
                <div class="col-12 col-md-4">
                    <div class="card text-bg-dark">
                        <img src="{{ Storage::url($image->path) }}" class="card-img" alt="...">
                        <div class="card-img-overlay">
                          <p class="card-text"><small>{{ $image->created_at->diffForHumans() }}</small></p>
                        </div>
                    </div>
                    @if($image->comment)
                        <div class="text-center my-3">
                            <p>{!! $image->comment->content !!}</p>
                        </div>
                    @else
                        <div class="my-3">
                            <form class="p-2 border" method="POST" action="{{ route('comment.store', compact('image')) }}">
            
                                @csrf

                                <div class="mb-3">
                                    <label for="content" class="form-label">Commento</label>
                                    <textarea name="content" id="content" cols="30" rows="2" class="form-control"></textarea>
                                </div>
            
                                <button type="submit" class="btn btn-primary">Inserisci commento</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    @else

    <div class="container my-5">
        <div class="row justify-content-center text-center">
            <p>Loggati per inserire e vedere le tue immagini salvate</p>
        </div>
    </div>

    @endauth




</x-layout>