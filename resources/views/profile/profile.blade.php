@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <div class="container mt-4">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="row">
            <div class="container">
                <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
                    @csrf
                    <div class="card profile-card">
                        <div class="card-header">
                            <h3>Ваши данные</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Фамилия</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="first_name" class="form-label">Имя</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Отчество</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Телефон</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" disabled>
                                <div class="invalid-feedback" id="phoneError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="login" class="form-label">Логин</label>
                                <input type="text" class="form-control" id="login" name="login" value="{{ $user->login }}" disabled readonly
                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Логин изменить нельзя">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" id="editButton">Изменить данные</button>
                            <button type="button" class="btn btn-secondary d-none" id="cancelButton">Отмена</button>
                            <button type="submit" class="btn btn-success d-none" id="saveButton">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function (tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });

            const originalValues = {
                lastName: $('#last_name').val(),
                firstName: $('#first_name').val(),
                middleName: $('#middle_name').val(),
                phone: $('#phone').val(),
            };

            $('#phone').on('input', function() {
                let input = $(this).val().replace(/\D/g, '').substring(0, 11);
                let formatted = '+7';

                if (input.length > 1) {
                    formatted += ' (' + input.substring(1, 4);
                }
                if (input.length >= 4) {
                    formatted += ') ' + input.substring(4, 7);
                }
                if (input.length >= 7) {
                    formatted += '-' + input.substring(7, 9);
                }
                if (input.length >= 9) {
                    formatted += '-' + input.substring(9, 11);
                }

                $(this).val(formatted);
            });

            $('#editButton').on('click', function () {
                $('#profileForm input:not([readonly])').prop('disabled', false);
                $('#saveButton').removeClass('d-none');
                $('#cancelButton').removeClass('d-none');
                $(this).addClass('d-none');
            });

            $('#cancelButton').on('click', function () {
                $('#last_name').val(originalValues.lastName);
                $('#first_name').val(originalValues.firstName);
                $('#middle_name').val(originalValues.middleName);
                $('#phone').val(originalValues.phone);

                $('#profileForm input:not([readonly])').prop('disabled', true);
                $('#saveButton').addClass('d-none');
                $(this).addClass('d-none');
                $('#editButton').removeClass('d-none');
            });

            $('#profileForm').on('submit', function(event) {
                const phone = $('#phone').val();
                const phonePattern = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;

                $('#phone').removeClass('is-invalid');
                $('#phoneError').text('');

                if (!phonePattern.test(phone)) {
                    event.preventDefault();
                    $('#phone').addClass('is-invalid');
                    $('#phoneError').text('Введите корректный номер телефона');
                }
            });
        });
    </script>

    <style>
        body {
            background-color: #CDD8FF;
            font-family: "Playfair Display", serif;
            font-weight: 600;
            color: #333;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .card {
            background-color: #CDD8FF;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #B0C4DE;
            border-bottom: 1px solid #9FB6CD;
            padding: 10px 15px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .form-control {
        border: 1px solid #B0C4DE;
        }

        .form-control:focus {
            border-color: #9FB6CD;
            box-shadow: 0 0 0 0.2rem rgba(159, 182, 205, 0.25);
        }

        .btn {
            border-radius: 5px;
            padding: 8px 16px;
        }

        .btn-primary {
            background-color: #9FB6CD;
            border-color: #9FB6CD;
        }

        .btn-secondary {
            background-color: #B0C4DE;
            border-color: #B0C4DE;
        }

        .btn-success {
            background-color: #90EE90;
            border-color: #90EE90;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
        }

        .bg-info {
            background-color: #B0E0E6 !important;
        }

        .alert-success {
            background-color: #90EE90;
            border-color: #98FB98;
            color: #006400;
        }

        .border-bottom {
            border-bottom: 1px solid #B0C4DE !important;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        .invalid-feedback {
            color: #DC143C;
        }
    
    </style>
@endsection
