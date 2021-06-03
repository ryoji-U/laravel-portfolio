<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログインフォーム</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>ブログ投稿フォーム</h2>
            <form method="POST" action="{{ route('signup') }}">
                @csrf
                <div class="form-group">
                    <label for="name">
                        氏名
                    </label>
                    <input
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        type="text"
                    >
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">
                        メールアドレス
                    </label>
                    <input
                        id="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        type="email"
                    >
                    @if ($errors->has('email'))
                        <div class="text-danger">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email-validation">
                        メールアドレス（確認用）
                    </label>
                    <input
                        id="email-validation"
                        name="email-validation"
                        class="form-control"
                        value="{{ old('email-validation') }}"
                        type="email"
                    >
                    @if ($errors->has('email-validation'))
                        <div class="text-danger">
                            {{ $errors->first('email-validation') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">
                        パスワード
                    </label>
                    <textarea
                        id="password"
                        name="password"
                        class="form-control"
                        rows="4"
                        type="password"
                    >{{ old('password') }}</textarea>
                    @if ($errors->has('password'))
                        <div class="text-danger">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="mt-5">
                    <a class="btn btn-secondary" href="{{ route('blogs') }}">
                        キャンセル
                    </a>
                    <button type="submit" class="btn btn-primary">
                        登録
                    </button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>