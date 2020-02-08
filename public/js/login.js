$(function() {

	$("#login_form").submit(function() { //quando o formulário for submetido

		$.ajax({
			type: "post",
			url: BASE_URL + "restrict/ajax_login",
			dataType: "json",
			data: $(this).serialize(), //pega todos os campos do form
			beforeSend: function() {
				clearErrors();
				$("#btn_login").parent().siblings(".help-block").html(loadingImg("Verificando...")); //retornar o círculo girando + mensagem verificando
			},
			success: function(json) { 
				if (json["status"] == 1) { //se logou
					//clearErrors();
					$("#btn_login").parent().siblings(".help-block").html(loadingImg("Logando...")); //indica para o usuário que o login deu certo
					window.location = BASE_URL + "restrict";
				} else {
					showErrors(json["error_list"]); //se deu erro, mostra lista de erros
				}
			},
			error: function(response) {
				console.log(response);
			}
		})

		return false;
	})

})