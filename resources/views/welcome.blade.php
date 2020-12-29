
<form action="api/import-csv" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="Ct88FZ63QFjALUXpfJzmstEps9MeYJnqN654LH6D">    <input type="file" name="file" accept=".csv"><br>
    <input type="hidden" name="contact_id" value="10" accept=".csv"><br>
    <label>First name</label>
    <input type="number" class="form-control" min="-1" name="firstname" value="-1">
    <label>Last name</label>
    <input type="number" class="form-control" min="-1" name="lastname" value="-1">
    <label>Phone</label>
    <input type="number" class="form-control" min="-1" name="phone" value="-1">
    <input type="submit" value="Import CSV" class="btn btn-warning">
</form>
<hr>
<hr>
<form action="api/export-csv" method="GET">
    <input type="hidden" name="_token" value="Ct88FZ63QFjALUXpfJzmstEps9MeYJnqN654LH6D">    <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
</form>

<form action="/request" method="get">

    <input type="text" name="ab" class="btn btn-success">
    <button>ok</button>
</form>
<hr>
<hr>
<!-- <div style="text-align:center; margin-top:50px;">
    <label>Đăng kí tài khoản</label>
    <form action="http://127.0.0.1:8000/api/store" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Full name</label>
            <input type="text" name="fullname">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password confirmation</label>
            <input type="password" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div> -->
<!-- <hr><hr>
<div style="text-align:center; margin-top:50px;">
    <label>Đăng nhap tài khoản</label>
    <form action="{{route('api.user.login')}}" method="POST">
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password confirmation</label>
            <input type="password" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <label>Dien email de lay tai mat khau</label>
    <form action="{{route('api.user.sendmail_resetpw')}}" method="POST">
        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="email" name="email">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr><hr><hr>
    <label>Đăt lại mật khẩu</label>
    <form action="{{route('api.user.reset_password') }}" method="POST">
        <input type="hidden" name="email" value="">
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="new_password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password confirmation</label>
            <input type="password" name="new_confirm_password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div> -->
