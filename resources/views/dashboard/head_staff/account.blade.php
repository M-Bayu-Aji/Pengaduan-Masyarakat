@extends('dashboard.templates.app')

@section('content')
    <!-- Page Header -->
    <div class="mb-6">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-2 text-white h3 fw-bold">
                    <i class="fas fa-users-cog me-3"></i>
                    Manajemen Akun Staff
                </h2>
                <p class="mb-0 text-white-50">Kelola akun staff untuk daerah {{ $province }}</p>
            </div>
            <div class="d-flex align-items-center">
                <span class="px-3 py-2 badge bg-primary fs-6">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $province }}
                </span>
            </div>
        </div>
    </div>

    <!-- Alert Section -->
    @if (Session::get('success'))
        <div class="mb-4 border-0 shadow-lg alert alert-success alert-dismissible fade show"
             style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 16px;" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-5"></i>
                <div class="flex-grow-1">
                    <strong>Berhasil!</strong> {{ Session::get('success') }}
                </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Content Grid -->
    <div class="row g-4">
        <!-- Staff Accounts List -->
        <div class="col-lg-8">
            <div class="border-0 shadow-lg card h-100"
                 style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-radius: 20px;">
                <div class="p-4 bg-transparent border-0 card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 card-title fw-bold text-dark">
                                <i class="fas fa-list-ul me-2 text-primary"></i>
                                Daftar Akun Staff
                            </h5>
                            <p class="mb-0 text-muted small">Kelola dan monitor akun staff aktif</p>
                        </div>
                        <span class="px-3 py-2 badge bg-primary-subtle text-primary rounded-pill">
                            {{ $accounts->where('staffProvince.province', auth()->user()->staffProvince->province)->count() }} Akun
                        </span>
                    </div>
                </div>
                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 border-0 fw-semibold text-muted">#</th>
                                    <th class="px-4 py-3 border-0 fw-semibold text-muted">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </th>
                                    <th class="px-4 py-3 border-0 fw-semibold text-muted">
                                        <i class="fas fa-calendar me-2"></i>Dibuat
                                    </th>
                                    <th class="px-4 py-3 text-center border-0 fw-semibold text-muted">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accounts->where('staffProvince.province', auth()->user()->staffProvince->province) as $account)
                                    <tr class="staff-row" style="transition: all 0.3s ease;">
                                        <td class="px-4 py-3 align-middle">
                                            <span class="badge bg-light text-dark rounded-pill">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="px-4 py-3 align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-3"
                                                     style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                                    {{ strtoupper(substr($account->email, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-semibold text-dark">{{ $account->email }}</div>
                                                    <small class="text-muted">Staff Account</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 align-middle">
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>
                                                {{ $account->created_at->format('d M Y') }}
                                            </small>
                                        </td>
                                        <td class="px-4 py-3 text-center align-middle">
                                            <div class="btn-group" role="group">
                                                <!-- Reset Password Button -->
                                                <form action="{{ route('head.staff.reset', $account->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-outline-primary btn-sm me-2"
                                                            style="border-radius: 8px; font-weight: 500;"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Reset Password">
                                                        <i class="fas fa-key me-1"></i>Reset
                                                    </button>
                                                </form>

                                                <!-- Delete Button -->
                                                @if ($account->responses->isEmpty())
                                                    <form action="{{ route('head.staff.delete', $account->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-outline-danger btn-sm delete-btn"
                                                                style="border-radius: 8px; font-weight: 500;"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Hapus Akun"
                                                                onclick="return confirmDelete('{{ $account->email }}')">
                                                            <i class="fas fa-trash me-1"></i>Hapus
                                                        </button>
                                                    </form>
                                                @else
                                                    <button type="button"
                                                            class="btn btn-outline-secondary btn-sm"
                                                            style="border-radius: 8px; font-weight: 500;"
                                                            disabled
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="Tidak dapat dihapus - Staff memiliki tanggapan aktif">
                                                        <i class="fas fa-lock me-1"></i>Terkunci
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-5 text-center">
                                            <div class="text-muted">
                                                <i class="mb-3 opacity-50 fas fa-users fa-3x"></i>
                                                <h6>Belum ada akun staff</h6>
                                                <p class="small">Buat akun staff pertama untuk daerah ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Account Form -->
        <div class="col-lg-4">
            <div class="border-0 shadow-lg card h-100"
                 style="background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border-radius: 20px;">
                <div class="p-4 bg-transparent border-0 card-header">
                    <h5 class="mb-1 card-title fw-bold text-dark">
                        <i class="fas fa-user-plus me-2 text-success"></i>
                        Buat Akun Staff Baru
                    </h5>
                    <p class="mb-0 text-muted small">Tambahkan anggota staff baru untuk {{ $province }}</p>
                </div>
                <div class="p-4 card-body">
                    <form action="{{ route('head.staff.create.acc') }}" method="POST" id="createAccountForm">
                        @csrf
                        <input type="hidden" name="role" value="staff">

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="mb-2 form-label fw-semibold text-dark">
                                <i class="fas fa-envelope me-2 text-muted"></i>Email Address
                            </label>
                            <div class="input-group">
                                <span class="border-0 input-group-text bg-light">
                                    <i class="fas fa-at text-muted"></i>
                                </span>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       class="py-3 border-0 form-control bg-light"
                                       style="border-radius: 0 12px 12px 0;"
                                       placeholder="contoh@email.com"
                                       required>
                            </div>
                            <div class="form-text">Email akan digunakan untuk login ke sistem</div>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="mb-2 form-label fw-semibold text-dark">
                                <i class="fas fa-lock me-2 text-muted"></i>Password
                            </label>
                            <div class="input-group">
                                <span class="border-0 input-group-text bg-light">
                                    <i class="fas fa-key text-muted"></i>
                                </span>
                                <input type="password"
                                       id="password"
                                       name="password"
                                       class="py-3 border-0 form-control bg-light"
                                       style="border-radius: 0 12px 12px 0;"
                                       placeholder="Masukkan password"
                                       required>
                                <button class="border-0 btn btn-outline-secondary"
                                        type="button"
                                        id="togglePassword"
                                        style="border-radius: 0 12px 12px 0;">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="form-text">Password minimal 8 karakter</div>
                        </div>

                        <!-- Province Info -->
                        <div class="mb-4">
                            <div class="border-0 alert alert-info" style="background: rgba(99, 102, 241, 0.1); border-radius: 12px;">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Provinsi:</strong> {{ $province }}
                                <br><small class="text-muted">Staff akan ditempatkan di provinsi ini</small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit"
                                    class="py-3 btn btn-lg"
                                    id="submitBtn"
                                    style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; border-radius: 12px; color: white; font-weight: 600;">
                                <i class="fas fa-user-plus me-2"></i>
                                <span id="btnText">Buat Akun Staff</span>
                                <div class="spinner-border spinner-border-sm ms-2 d-none" id="btnSpinner" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .staff-row:hover {
            background-color: rgba(99, 102, 241, 0.05) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn:active {
            transform: translateY(0);
        }

        .input-group .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
            border-color: #6366f1;
        }

        .delete-btn:hover {
            background-color: #dc3545 !important;
            color: white !important;
            border-color: #dc3545 !important;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .badge {
            font-weight: 500;
        }

        .alert {
            border-radius: 16px;
        }

        .card {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeInUp 0.6s ease-out;
        }

        .staff-row {
            animation: fadeInUp 0.4s ease-out;
        }

        .staff-row:nth-child(even) {
            animation-delay: 0.1s;
        }

        .staff-row:nth-child(odd) {
            animation-delay: 0.2s;
        }
    </style>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Alert auto-close with smooth animation
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 5000);

            // Toggle password visibility
            $('#togglePassword').on('click', function() {
                const passwordField = $('#password');
                const icon = $(this).find('i');

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            // Form submission with loading state
            $('#createAccountForm').on('submit', function(e) {
                const submitBtn = $('#submitBtn');
                const btnText = $('#btnText');
                const btnSpinner = $('#btnSpinner');

                // Show loading state
                submitBtn.prop('disabled', true);
                btnText.text('Membuat Akun...');
                btnSpinner.removeClass('d-none');

                // Add shimmer effect
                submitBtn.addClass('loading-shimmer');
            });

            // Enhanced row hover effects
            $('.staff-row').hover(
                function() {
                    $(this).addClass('table-active');
                },
                function() {
                    $(this).removeClass('table-active');
                }
            );

            // Smooth button animations
            $('.btn').hover(
                function() {
                    $(this).addClass('shadow-lg');
                },
                function() {
                    $(this).removeClass('shadow-lg');
                }
            );

            // Form validation feedback
            $('input[required]').on('blur', function() {
                const input = $(this);
                const value = input.val().trim();

                if (value === '') {
                    input.addClass('is-invalid');
                    input.removeClass('is-valid');
                } else if (input.attr('type') === 'email') {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (emailRegex.test(value)) {
                        input.addClass('is-valid');
                        input.removeClass('is-invalid');
                    } else {
                        input.addClass('is-invalid');
                        input.removeClass('is-valid');
                    }
                } else {
                    input.addClass('is-valid');
                    input.removeClass('is-invalid');
                }
            });

            // Real-time password strength indicator
            $('#password').on('input', function() {
                const password = $(this).val();
                const strength = checkPasswordStrength(password);
                updatePasswordStrengthIndicator(strength);
            });

            // Add floating labels effect
            $('.form-control').on('focus blur', function(e) {
                const label = $(this).siblings('label');
                if (e.type === 'focus' || this.value.length > 0) {
                    label.addClass('active');
                } else {
                    label.removeClass('active');
                }
            });
        });

        // Enhanced delete confirmation
        function confirmDelete(email) {
            return new Promise((resolve) => {
                const result = confirm(
                    `Apakah Anda yakin ingin menghapus akun "${email}"?\n\n` +
                    `Aksi ini tidak dapat dibatalkan.`
                );
                resolve(result);
            }).then(result => {
                if (result) {
                    // Add loading state to delete button
                    event.target.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...';
                    event.target.disabled = true;
                }
                return result;
            });
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            return strength;
        }

        // Update password strength indicator
        function updatePasswordStrengthIndicator(strength) {
            const progressBar = $('#passwordStrength');
            const strengthText = $('#strengthText');

            let width, color, text;

            switch (strength) {
                case 0:
                case 1:
                    width = '20%';
                    color = '#dc3545';
                    text = 'Sangat Lemah';
                    break;
                case 2:
                    width = '40%';
                    color = '#fd7e14';
                    text = 'Lemah';
                    break;
                case 3:
                    width = '60%';
                    color = '#ffc107';
                    text = 'Sedang';
                    break;
                case 4:
                    width = '80%';
                    color = '#198754';
                    text = 'Kuat';
                    break;
                case 5:
                    width = '100%';
                    color = '#0d6efd';
                    text = 'Sangat Kuat';
                    break;
            }

            if (progressBar.length) {
                progressBar.css({
                    'width': width,
                    'background-color': color
                });
                strengthText.text(text).css('color', color);
            }
        }

        // Add smooth scroll to top after form submission
        $(window).on('beforeunload', function() {
            if ($('#createAccountForm').data('submitted')) {
                $('html, body').animate({ scrollTop: 0 }, 'fast');
            }
        });

        // Enhanced table animations
        $('.staff-row').each(function(index) {
            $(this).css({
                'animation-delay': (index * 0.1) + 's',
                'animation-fill-mode': 'both'
            });
        });

        // Add loading shimmer effect
        $(document).on('click', '.btn[type="submit"]', function() {
            if (!$(this).hasClass('loading-shimmer')) {
                $(this).addClass('loading-shimmer');
            }
        });
    </script>

    <style>
        /* Additional CSS for enhanced interactions */
        .loading-shimmer {
            background: linear-gradient(90deg,
                rgba(255,255,255,0.1) 0%,
                rgba(255,255,255,0.3) 50%,
                rgba(255,255,255,0.1) 100%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .form-control.is-valid {
            border-color: #198754;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='m2.3 6.73.7-.04 1.05-2.07 1.95-3.26h-.78L4.25 3.61 3.66 1.7H2.79l-.24.79L1.5 3.61.9 1.7H.1l1.05 3.26.04.04zM0 5.34v.47h8v-.47H0z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6.4.4.4-.4.4.4-.4.4.4.4-.4.4-.4-.4-.4.4-.4-.4.4-.4-.4-.4.4-.4z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .table-active {
            background-color: rgba(99, 102, 241, 0.1) !important;
        }

        .btn:focus {
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        /* Smooth transitions for all interactive elements */
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom scrollbar for the table */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: rgba(0,0,0,0.1);
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 4px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
    </style>
@endpush
