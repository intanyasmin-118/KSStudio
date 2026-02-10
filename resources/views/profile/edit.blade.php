<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap"
        rel="stylesheet">
    <title>Manage Profile</title>
    <style>
        body {
            font-family: "TikTok Sans", sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 35px auto 40px;
            padding: 0 18px;
        }

        /* BACK BUTTON (OUTSIDE BOX BUT INSIDE CONTAINER) */
        .back-top {
            display: inline-block;
            margin: 0 0 18px 0;
            text-decoration: none;
            color: #111;
            font-weight: 600;
            font-size: 18px;
        }

        /* BIG BOX */
        .page-box {
            border: 1px solid #eee;
            border-radius: 18px;
            padding: 26px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .brand {
            font-size: 20px;
            font-weight: 600;
            color: #c36b2c;
        }

        .title {
            font-size: 34px;
            font-weight: 600;
            margin: 10px 0 0;
            font-family: "TikTok Sans", sans-serif;
        }

        .subtitle {
            margin-top: 6px;
            color: #666;
            font-size: 14px;
        }

        .success {
            background: #e9f9ee;
            border: 1px solid #bfe9cb;
            color: #1b6b2b;
            padding: 10px 12px;
            border-radius: 12px;
            font-size: 13px;
            margin-top: 16px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin: 10px 0 6px;
        }

        .required {
            color: #c10000;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 14px 14px;
            border-radius: 12px;
            border: 1px solid #ddd;
            background: #f3f3f3;
            outline: none;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #c36b2c;
            background: #fff;
        }

        input.is-invalid {
            border: 2px solid #e00000;
            background: #fff;
        }

        .error-text {
            margin-top: 6px;
            font-size: 12px;
            font-weight: 800;
            color: #e00000;
        }

        .btn-submit {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            background: #c36b2c;
            color: #fff;
            margin-top: 10px;
        }

        .btn-submit:hover {
            opacity: 0.95;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- BACK BUTTON (OUTSIDE BOX) --}}
        @if(session('role') === 'admin')
            <a class="back-top" href="/admin/dashboard">← Back</a>
        @else
            <a class="back-top" href="/user/dashboard">← Back</a>
        @endif

        {{-- BIG BOX --}}
        <div class="page-box">

            <div class="title">Manage Profile</div>
            <div class="subtitle">Update your personal information</div>

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="/profile">
                @csrf

                {{-- FULLNAME --}}
                <div class="form-group">
                    <label>Full Name <span class="required">*</span></label>

                    <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}"
                        class="@error('fullname') is-invalid @enderror" required>

                    @error('fullname')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="form-group">
                    <label>Email <span class="required">*</span></label>

                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="@error('email') is-invalid @enderror" required>

                    @error('email')
                        <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    Save Changes
                </button>

            </form>

        </div>

    </div>

</body>

</html>