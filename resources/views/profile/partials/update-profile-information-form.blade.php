<div class="max-w-7xl mx-auto px-4 py-6" x-data="{ openModal: false }">
    <!-- Breadcrumb -->
    <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
        <ol class="flex space-x-2">
            <li>
                <a href="{{ route('dashboard') }}" class="hover:underline text-blue-600">Home</a>
                <span class="mx-2">/</span>
            </li>
            <li class="text-gray-600">Pengaturan</li>
        </ol>
    </nav>

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Pengaturan</h2>

    <!-- Tabs -->
    <div class="flex border-b border-gray-200 mb-6 space-x-4">
        <a href="#" class="text-green-600 font-semibold border-b-2 border-green-600 pb-2">User Profile</a>
        <a href="#" class="text-gray-500 hover:text-gray-700 pb-2">Alamat</a>
        <a href="#" class="text-gray-500 hover:text-gray-700 pb-2">Keamanan dan Privasi</a>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- Photo Column -->
        <div class="bg-white border rounded-xl p-6 text-center">
            @if($user->photo)
    <img src="{{ asset('storage/'.$user->photo) }}"
         class="w-64 h-40 object-cover mx-auto mb-4 rounded-lg shadow">
@else
    <div class="w-64 h-40 mx-auto flex items-center justify-center border rounded-lg bg-gray-100 text-gray-500">
        Belum ada foto
    </div>
@endif


            <button class="mt-4 w-full border border-green-500 text-green-600 hover:bg-green-50 rounded-lg py-2"
                    data-bs-toggle="modal" 
                    data-bs-target="#editModal">
                <i class="fas fa-camera mr-2"></i>Ubah Foto
            </button>
        </div>

        <!-- Profile Info Column -->
        <div class="md:col-span-2 bg-white border rounded-xl p-6">
            <h5 class="text-lg font-semibold mb-4">Ubah Biodata Diri</h5>

            <div class="mb-4">
                <span class="font-semibold">Nama:</span> <span id="displayNama">{{ $user->name }}</span>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Email:</span> <span id="displayEmail">{{ $user->email }}</span>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Nomor HP:</span> <span id="displayNomorHp">{{ $user->phone ?? '-' }}</span>
            </div>

            <!-- Tombol Edit -->
            <!-- Tombol Edit Profile -->

        <button 
            type="button"
            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
            data-bs-toggle="modal"
            data-bs-target="#editProfileModal">
            <i class="fas fa-edit mr-2"></i>Edit Profile
        </button>

        </div>
    </div>
</div>

<!-- Modal Edit Profile -->
<!-- Floating Form (Modal Slide Up) -->
<!-- Modal Edit Profile -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-bottom">
    <div class="modal-content rounded-top-4">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="editProfileModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="modal-body">

          <!-- Foto -->
          <div class="text-center mb-4">
            @if($user->photo)
              <img src="{{ asset('storage/'.$user->photo) }}" id="profilePhotoPreview"
                   class="rounded-circle w-24 h-24 object-cover mx-auto mb-2">
            @else
              <div id="profilePhotoPreview" class="rounded-circle bg-light w-24 h-24 d-flex justify-content-center align-items-center mx-auto mb-2 text-muted">
                  No Photo
              </div>
            @endif
            <div class="mt-2">
              <label for="photo" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-upload me-1"></i> Upload Foto
              </label>
              <input type="file" id="photo" name="photo" class="d-none" accept="image/*">
              <x-input-error class="mt-2 text-danger small" :messages="$errors->get('photo')" />
            </div>
          </div>

          <!-- Nama -->
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control">
            <x-input-error class="mt-1 text-danger small" :messages="$errors->get('name')" />
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control">
            <x-input-error class="mt-1 text-danger small" :messages="$errors->get('email')" />
          </div>

          <!-- Telepon -->
          <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
            <x-input-error class="mt-1 text-danger small" :messages="$errors->get('phone')" />
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>
<style>
    [x-cloak] { display: none !important; }
</style>

@push('scripts')
<script>
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('profilePhotoPreview');
                if (preview.tagName === 'DIV') {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.className = 'rounded-circle w-24 h-24 object-cover mx-auto mb-3';
                    preview.parentNode.replaceChild(img, preview);
                    img.id = 'profilePhotoPreview';
                } else {
                    preview.src = event.target.result;
                }
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
    
@endpush
