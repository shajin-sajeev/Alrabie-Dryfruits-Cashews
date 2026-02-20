@extends('layouts.admin')

@section('admin-title', 'My Profile')
@section('admin-subtitle', 'Manage your account settings and profile picture')

@section('admin-content')
<div class="profile-container animate-fade-in-up">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="form-card">
        @csrf
        @method('PUT')

        <div class="profile-header-section">
            <div class="profile-pic-wrapper">
                <div class="profile-pic-preview" id="profilePicPreview">
                    @if($admin->profile_picture)
                        <img src="{{ str_starts_with($admin->profile_picture, 'data:') ? $admin->profile_picture : \Illuminate\Support\Facades\Storage::url($admin->profile_picture) }}" alt="{{ $admin->name }}" id="previewImg">
                    @else
                        <div class="avatar-placeholder">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <img src="" alt="" id="previewImg" style="display: none;">
                    @endif
                    <div class="pic-overlay">
                        <i class="fas fa-camera"></i>
                        <span>Change Photo</span>
                    </div>
                </div>
                <input type="file" name="profile_picture" id="profilePicInput" accept="image/*" style="display: none;">
                @error('profile_picture')
                    <span class="error-text" style="text-align: center;">{{ $message }}</span>
                @enderror
                <p class="pic-help-text">Recommended: Square, JPG/PNG, max 2MB</p>
            </div>

            <div class="profile-main-info">
                <h3>{{ $admin->name }}</h3>
                <p>{{ $admin->email }}</p>
                <span class="badge badge-primary">Master Admin</span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-user"></i> Full Name
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required>
                @error('name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope"></i> Email Address
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required>
                @error('email')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-divider">
            <span>Security Settings</span>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i> New Password
                </label>
                <input type="password" name="password" id="password" placeholder="Leave blank to keep current">
                @error('password')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">
                    <i class="fas fa-shield-halved"></i> Confirm New Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your new password">
            </div>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Profile Changes
            </button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>

<style>
    .profile-header-section {
        display: flex;
        align-items: center;
        gap: 2.5rem;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--border-color);
    }

    .profile-pic-wrapper {
        text-align: center;
    }

    .profile-pic-preview {
        width: 140px;
        height: 140px;
        border-radius: var(--radius-lg);
        background: var(--bg-main);
        border: 4px solid white;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        position: relative;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-pic-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-placeholder {
        font-size: 3.5rem;
        color: var(--text-muted);
    }

    .pic-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: opacity var(--duration);
        gap: 0.5rem;
    }

    .profile-pic-preview:hover .pic-overlay {
        opacity: 1;
    }

    .pic-overlay i {
        font-size: 1.5rem;
    }

    .pic-overlay span {
        font-size: 0.75rem;
        font-weight: 600;
    }

    .pic-help-text {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 1rem;
    }

    .profile-main-info h3 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
        color: var(--text-main);
    }

    .profile-main-info p {
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .badge {
        display: inline-block;
        padding: 0.35rem 1rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .badge-primary {
        background: var(--primary-light);
        color: var(--primary-dark);
    }

    .form-divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 2.5rem 0 1.5rem;
        color: var(--text-muted);
    }

    .form-divider::before,
    .form-divider::after {
        content: "";
        flex: 1;
        border-bottom: 1px solid var(--border-color);
    }

    .form-divider span {
        margin: 0 1.5rem;
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .error-text {
        color: var(--danger);
        font-size: 0.8125rem;
        margin-top: 0.5rem;
        display: block;
    }

    @media (max-width: 640px) {
        .profile-header-section {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const picPreview = document.getElementById('profilePicPreview');
        const picInput = document.getElementById('profilePicInput');
        const previewImg = document.getElementById('previewImg');
        const placeholder = document.querySelector('.avatar-placeholder');

        picPreview.addEventListener('click', () => picInput.click());

        picInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
