@extends('layouts/app')

@section('title', 'main page')

@section('content')
    <div style="display: flex; gap: 50px;">
        <!-- Search Pet Section -->
        <div>
            <h2>Search pets by</h2>
            <form action="/pet/get" class="form">
                @csrf
                <div class="form-control">
                    <label for="searchId">Pet ID:</label>
                    <input type="number" name="searchId" id="searchId" min="0" max="9223372036854775807">
                    <div class="form-error">
                        @if ($errors->has('searchId'))
                            {{ $errors->first('searchId') }}
                        @endif
                    </div>
                </div>

                <div style="align-self: center; font-weight: bold">
                    OR
                </div>

                <div class="form-control">
                    <label for="searchStatus">Pet status:</label>
                    <select name="searchStatus" id="searchStatus">
                        <option value=""></option>
                        @foreach(config('petStatus') as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                    <div class="form-error">
                        @if ($errors->has('searchStatus'))
                            {{ $errors->first('searchStatus') }}
                        @endif
                    </div>
                </div>

                <input type="reset" value="Reset">
                <input type="submit" value="Search">
            </form>
        </div>

        <!-- Delete Pet Section -->
        <div>
            <h2>Delete pet</h2>
            <form action="/pet/delete" method="POST" class="form">
                @method('DELETE')
                @csrf
                <div class="form-control">
                    <label for="deleteId">Delete Pet by ID:<span class="form-required">*</span></label>
                    <input type="number" name="deleteId" id="deleteId" min="0" max="9223372036854775807">
                    <div class="form-error">
                        @if ($errors->has('deleteId'))
                            {{ $errors->first('deleteId') }}
                        @endif
                    </div>
                </div>
                <input type="submit" value="Delete">
            </form>
        </div>
    </div>

    <div>
        <h2>Manage Pet</h2>

        <!-- Buttons to toggle forms -->
        <div>
            <button id="createPetButton">Create Pet</button>
            <button id="editPetButton">Edit Pet</button>
            {{--            <button id="uploadImageButton">Upload Image</button>--}}
        </div>

        <!-- Create Pet Form -->
        <div id="createPetForm" style="display: none;">
            <h3>Create Pet</h3>
            <form action="/pet/create" method="POST" class="form">
                @csrf
                <div class="form-control">
                    <label for="manageId">Pet ID:<span class="form-required">*</span></label>
                    <input type="number" name="manageId" id="manageId" min="0" max="9223372036854775807" value="0">
                    <div class="form-error">
                        @if ($errors->has('manageId'))
                            {{ $errors->first('manageId') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="manageName">Name:<span class="form-required">*</span></label>
                    <input type="text" name="manageName" id="manageName" value="{{ old('manageName') }}">
                    <div class="form-error">
                        @if ($errors->has('manageName'))
                            {{ $errors->first('manageName') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="managePhotoUrls">Photo urls:<span class="form-required">*</span></label>
                    <textarea name="managePhotoUrls" id="managePhotoUrls" cols="30" rows="5" placeholder="type each URL in new line">{{ old('managePhotoUrls') }}</textarea>
                    <div class="form-error">
                        @if ($errors->has('managePhotoUrls'))
                            {{ $errors->first('managePhotoUrls') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="manageCategory">Category:</label>
                    <input type="text" name="manageCategory" id="manageCategory" value="{{ old('manageCategory') }}">
                    <div class="form-error">
                        @if ($errors->has('manageCategory'))
                            {{ $errors->first('manageCategory') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="manageTags">Tags:</label>
                    <textarea name="manageTags" id="manageTags" cols="30" rows="5" placeholder="type each tag in new line">{{ old('manageTags') }}</textarea>
                    <div class="form-error">
                        @if ($errors->has('manageTags'))
                            {{ $errors->first('manageTags') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="manageStatus">Status:</label>
                    <select name="manageStatus" id="manageStatus">
                        <option value=""></option>
                        @foreach(config('petStatus') as $status)
                            <option value="{{ $status }}" {{ old('manageStatus') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    <div class="form-error">
                        @if ($errors->has('manageStatus'))
                            {{ $errors->first('manageStatus') }}
                        @endif
                    </div>
                </div>

                <input type="submit" value="Create Pet">
            </form>
        </div>

        <!-- Edit Pet Form -->
        <div id="editPetForm" style="display: none;">
            <h3>Edit Pet</h3>
            <form action="/pet/update" method="POST" class="form">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-control">
                    <label for="manageId">Pet ID:<span class="form-required">*</span></label>
                    <input type="number" name="manageId" id="manageId" min="0" max="9223372036854775807" value="{{ old('manageId') }}">
                    <div class="form-error">
                        @if ($errors->has('manageId'))
                            {{ $errors->first('manageId') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="manageName">Name:<span class="form-required">*</span></label>
                    <input type="text" name="manageName" id="manageName" value="{{ old('manageName') }}">
                    <div class="form-error">
                        @if ($errors->has('manageName'))
                            {{ $errors->first('manageName') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="managePhotoUrls">Photo urls:<span class="form-required">*</span></label>
                    <textarea name="managePhotoUrls" id="managePhotoUrls" cols="30" rows="5" placeholder="type each URL in new line">{{ old('managePhotoUrls') }}</textarea>
                    <div class="form-error">
                        @if ($errors->has('managePhotoUrls'))
                            {{ $errors->first('managePhotoUrls') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="manageCategory">Category:</label>
                    <input type="text" name="manageCategory" id="manageCategory" value="{{ old('manageCategory') }}">
                    <div class="form-error">
                        @if ($errors->has('manageCategory'))
                            {{ $errors->first('manageCategory') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="manageTags">Tags:</label>
                    <textarea name="manageTags" id="manageTags" cols="30" rows="5" placeholder="type each tag in new line">{{ old('manageTags') }}</textarea>
                    <div class="form-error">
                        @if ($errors->has('manageTags'))
                            {{ $errors->first('manageTags') }}
                        @endif
                    </div>
                </div>

                <div class="form-control">
                    <label for="manageStatus">Status:</label>
                    <select name="manageStatus" id="manageStatus">
                        <option value=""></option>
                        @foreach(config('petStatus') as $status)
                            <option value="{{ $status }}" {{ old('manageStatus') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    <div class="form-error">
                        @if ($errors->has('manageStatus'))
                            {{ $errors->first('manageStatus') }}
                        @endif
                    </div>
                </div>

                <input type="submit" value="Update Pet">
            </form>
        </div>

        <!-- Upload Image Form -->
        {{--        <div id="uploadImageForm" style="display: none;">--}}
        {{--            <h3>Upload Image</h3>--}}
        {{--            <form action="/pet/uploadImage" method="POST" enctype="multipart/form-data" class="form">--}}
        {{--                @csrf--}}
        {{--                <div class="form-control">--}}
        {{--                    <label for="uploadImage">Image:</label>--}}
        {{--                    <input type="file" name="uploadImage" id="uploadImage">--}}
        {{--                </div>--}}
        {{--                <div class="form-control">--}}
        {{--                    <label for="uploadId">Pet ID:</label>--}}
        {{--                    <input type="number" name="uploadId" id="uploadId" min="0">--}}
        {{--                </div>--}}
        {{--                <div class="form-control">--}}
        {{--                    <label for="additionalMetadata">Additional Metadata:</label>--}}
        {{--                    <input type="text" name="additionalMetadata" id="additionalMetadata">--}}
        {{--                </div>--}}
        {{--                <input type="submit" value="Upload Image">--}}
        {{--            </form>--}}
        {{--        </div>--}}
    </div>

    <h1 class="form-success">
        {{ Session::get('success') ?? '' }}
    </h1>

    <h1 class="form-error">
        {{ Session::get('error') ?? '' }}
    </h1>

    <div>
        @if(Session::has('data'))
            @foreach(Session::get('data')['pets'] as $pet)
                <!-- Pet details display -->
            @endforeach
        @endif
    </div>

    <script>
        // JavaScript to toggle between forms
        document.getElementById('createPetButton').addEventListener('click', function() {
            document.getElementById('createPetForm').style.display = 'block';
            document.getElementById('editPetForm').style.display = 'none';
            document.getElementById('uploadImageForm').style.display = 'none';
        });

        document.getElementById('editPetButton').addEventListener('click', function() {
            document.getElementById('createPetForm').style.display = 'none';
            document.getElementById('editPetForm').style.display = 'block';
            document.getElementById('uploadImageForm').style.display = 'none';
        });

        document.getElementById('uploadImageButton').addEventListener('click', function() {
            document.getElementById('createPetForm').style.display = 'none';
            document.getElementById('editPetForm').style.display = 'none';
            document.getElementById('uploadImageForm').style.display = 'block';
        });
    </script>
@endsection
