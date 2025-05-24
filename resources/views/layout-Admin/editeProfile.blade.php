<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4">
        <button type="button" class="btn btn-primary">
            <i class="bi bi-arrow-left-short"></i>
            <a href="{{ route('admin.profile') }}" style='color:white'>Retour</a>
        </button>
        <div class="modal-header">
            <h5 class="modal-title">Informations de profil</h5>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="check" value="No change" class="check_avatar">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <i class="bi bi-x-circle remove-button"></i>
                            <div class="profile-img-wrap edit-img">
                        @if (Auth::user()->avatar)
                            <!-- Afficher l'avatar de l'utilisateur s'il existe -->
                            <img class="inline-block" src="{{ asset(Auth::user()->avatar) }}" alt="user-profile" onerror="this.src='{{ asset('storage/avatars/user.jpg') }}';">
                        @else
                            <!-- Afficher l'image par défaut si aucun avatar -->
                            <img class="inline-block" alt="user-profile" src="{{ asset('storage/avatars/user.jpg') }}">
                        @endif

                        <!-- Section pour uploader un nouvel avatar -->
                        <div class="fileupload btn">
                            <span class="btn-text">Modifier</span>
                            <input class="upload" name="avatar" type="file" accept="image/png, image/gif, image/jpeg">
                        </div>
                    </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nom complet</label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date de naissance</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" name="bithdate" type="date" value="{{ Auth::user()->bithdate }}">
                                        @error('bithdate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="email" type="email" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Adresse</label>
                            <input type="text" name="adriss" class="form-control" value="{{ Auth::user()->adriss }}">
                            @error('adriss')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ville</label>
                            <input type="text" name="city" class="form-control" value="{{ Auth::user()->city }}">
                            @error('city')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pays</label>
                            <input type="text" name="contry" class="form-control" value="{{ Auth::user()->contry }}">
                            @error('contry')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Code postal</label>
                            <input type="text" name="pinecode" class="form-control" value="{{ Auth::user()->pinecode }}">
                            @error('pinecode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Numéro de téléphone</label>
                            <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirmer le mot de passe</label>
                            <input type="password" class="form-control" name="password_confirmation">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var check = document.querySelector('.check_avatar');
    var fileInput = document.querySelector('.upload');
    var removeButton = document.querySelector('.remove-button');

    fileInput.addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.querySelector('.inline-block');
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
            check.value = "changed"; // Indique qu'un nouvel avatar est uploadé
        }
    });

    removeButton.addEventListener('click', function() {
        var img = document.querySelector('.inline-block');
        img.src = '{{ asset("img/profiles/Yousef.jpg") }}';
        fileInput.value = ''; // Réinitialise le champ de fichier
        check.value = "removed"; // Indique que l'avatar a été supprimé
    });
</script>