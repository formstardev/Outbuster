@extends('layouts.account')

@section('content')
    <div class="content profile">
        <h2 class="title">Mon profil</h2>

        <form name="myForm" action="{{ route('account.profile.update') }}" method="POST" class="form"
            enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row">
                <div class="col-6">
                    @include('layouts.error')
                    <div class="form-group">
                        <label for="">Pseudo :</label>
                        <input type="text" class="form-control" name="username" value="{{ auth()->user()->username }}"
                            placeholder="Pseudo">
                    </div>
                    <div class="form-group">
                        <label for="">Mot de passe :</label>
                        <input class="form-control" type="password" name="password" value="" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                        <label for="">Adresse e-mail :</label>
                        <input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}"
                            placeholder="Adresse e-mail">
                    </div>
                    <div class="form-group">
                        <label for="">Inscription Newsletter :</label>
                        <select name="newsletter_subscription" id="" class="form-control">
                            <option></option>
                            <option {{ auth()->user()->newsletter_subscription == 'Non' ? 'selected' : '' }} value="Non">
                                Non</option>
                            <option value="Oui" {{ auth()->user()->newsletter_subscription == 'Oui' ? 'selected' : '' }}>
                                Oui
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="profile-detail">
                        <div class="img-wrap"><img style="max-height: 250px;" id="preview-image-before-upload"
                                src="{{ auth()->user()->avatar == '' ? url('assets/images/profile-picture.png') : url('storage/' . auth()->user()->avatar) }}"
                                alt="profile-picture"></div>
                        <div class="profile-text">
                            <span class="my-name">Mon avatar</span>
                            {{-- <a href="#0" class="edit-profile">Modifier mon avatar</a> --}}
                            <input type="file" name="image" placeholder="Choose image" id="image" hidden>
                            <label for="image" class="image-label">Modifier mon avatar</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="extra-form">
                        <div class="form-group">
                            <label for="">Date de naissance :</label>
                            <input type="text" id="birthday"
                                value="{{ auth()->user()->date_of_birth?date('d/m/Y', strtotime(auth()->user()->date_of_birth)):'' }}"
                                class="form-control" name="date_of_birth" placeholder="Date de naissance">
                        </div>
                        <div class="form-group">
                            <label for="">Sexe :</label>
                            <select name="gender" id="" class="form-control">
                                <option></option>
                                <option {{ auth()->user()->gender == 'Homme' ? 'selected' : '' }} value="Homme">
                                    Homme</option>
                                <option value="Womme" {{ auth()->user()->gender == 'Womme' ? 'selected' : '' }}>
                                    Womme
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pays :</label>
                            <select name="country_id" class="form-control">
                                <option value="0">-</option>
                                @foreach (App\Models\GpCountry::get() as $item)
                                    <option {{ auth()->user()->country_id == $item->id ? 'selected' : '' }}
                                        value="{{ $item->id }}"> {{ $item->country_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Adresse :</label>
                            <input type="text" value="{{ auth()->user()->address }}" class="form-control" name="address"
                                placeholder="Adresse">
                        </div>
                        <div class="form-group">
                            <label for="">Code Postal :</label>
                            <input type="text" value="{{ auth()->user()->zip_code }}" class="form-control"
                                name="zip_code" placeholder="Code Postal">
                        </div>
                        <div class="form-group">
                            <label for="">Ville :</label>
                            <input type="text" value="{{ auth()->user()->city }}" class="form-control" name="city"
                                placeholder="Ville">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="btn-wrap">
                    <a class="btn btn-gray" href="#0">Annuler</a>
                    <button type="submit" class="btn btn-black">Modifier mes informations</button>
                </div>
            </div>
        </form>
    </div>

    <style>
        .img-wrap>img {
            width: 180px;
            height: 180px;
        }

        .image-label {
            background-color: indigo;
            color: white;
            padding: 0.5rem;
            font-family: sans-serif;
            border-radius: 0.3rem;
            cursor: pointer;
            margin-top: 1rem;
            width: 100px;
            font-size: 13px;
            text-align: center;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#birthday').datepicker({ dateFormat: 'dd/mm/yy' }).val();
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
