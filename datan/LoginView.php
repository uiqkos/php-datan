<?php function LoginView() {?>
    <form action="<?php echo '..'.'/login'?>" method="post">
        <div class="form-group">
            <label for="field">Id пользователя</label>
            <input
                type="text"
                class="form-control"
                name="id"
                id="field"
            >
        </div>
        <div class="form-group">
            <label for="field">Пароль</label>
            <input
                type="text"
                class="form-control"
                name="password"
                id="field"
            >
        </div>
        <button
            type="submit"
            class="btn btn-primary"
            name="redirect"
            value="/"
        >Submit</button>
    </form>
<?php } ?>