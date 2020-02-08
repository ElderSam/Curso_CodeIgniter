
<!-- start: content -->
<!--div id="content">


    <div class="col-md-12" style="padding:20px;">
        <div class="col-md-12 padding-0">
            <div class="col-md-8 padding-0">
                sdfs
                <div class="col-md-12">
                    asdfas
                </div>
            </div>
            
        </div>

    
    </div-->
<!-- end: content -->


<div class="container" style="padding-top: 60px;">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
                <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Entrar</a>
                <a class="btn big-register" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Registre-se</a></div>
        <div class="col-sm-4"></div>
    </div>


        <div class="modal fade login" id="loginModal">
            <div class="modal-dialog login animated">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Login with</h4>
                </div>
                <div class="modal-body">
                    <div class="box">
                            <div class="content">
                            <div class="social">
                                <a href="#">
                                    <i class="fa fa-user fa-5x"></i>          
                                </a>                
                            </div>
                            
                            <div class="error"></div>
                            <div class="form loginBox">
                                <form method="" action="" accept-charset="UTF-8">
                                <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                <input id="password" class="form-control" type="password" placeholder="Senha" name="password">
                                <input class="btn btn-success btn-login" type="button" value="Entrar" onclick="loginAjax()">
                                </form>
                            </div>
                            </div>
                    </div>
                    <div class="box">
                        <div class="content registerBox" style="display:none;">
                            <div class="form">
                            <form method="" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                            <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                            <input id="password" class="form-control" type="password" placeholder="Senha" name="password">
                            <input id="password_confirmation" class="form-control" type="password" placeholder="Repita a senha" name="password_confirmation">
                            <input class="btn btn-success btn-register" type="button" value="Registrar" name="commit">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                        <span>Looking to
                                <a href="javascript: showRegisterForm();">criar uma conta</a>
                        ?</span>
                    </div>
                    <div class="forgot register-footer" style="display:none">
                            <span>Já possui uma conta?</span>
                            <a href="javascript: showLoginForm();">Entrar</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    openLoginModal();
});
</script>



