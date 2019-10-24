<div class="lightbox" id="join">
    <div class="lightbox-header">
        <h2>Registrera</h2>
    </div>
    <div class="login_register">
        <div class="lightbox-content">
            <div class="lightbox-join-content">
                <div class="lightbox-join-form">
                    <form id="signup" method="POST">
                        <input class="normal_input" type="text" name="username" placeholder="Användarnamn"
                            maxlength="32">
                        <input class="normal_input" type="email" name="email"
                            pattern="[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?"
                            placeholder="Email adress" maxlength="128">
                        <input class="normal_input" type="password" name="password" placeholder="Lösenord"
                            maxlength="128">
                        <input class="normal_input" type="password" name="password_confirm"
                            placeholder="Bekräfta lösenord" maxlength="128">
                        <div class="response_errors" style="display: none;"></div>
                        <input class="normal_submit" type="submit" name="register" value="Registrera användare">
                    </form>
                </div>
            </div>
        </div> <?php /* END lightbox-content */ ?>
    </div> <?php /* END login_register */ ?>
</div> <?php /* END lightbox join */ ?>
<script src="http://localhost/DT173G%20-%20Projekt/build/public/js/join/join.api.js"></script>