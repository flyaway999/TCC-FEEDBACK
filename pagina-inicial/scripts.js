function redirectLogin(event) {
  event.preventDefault(); // Impede o envio do formulário e recarregamento da página

  const emailInput = document.getElementById("email");
  const email = emailInput.value.trim().toLowerCase();

  const dominioValido = "@aluno.educacao.sp.gov.br";

  // Verifica se o email termina com o domínio institucional válido
  if (!email.endsWith(dominioValido)) {
    alert("Por favor, use seu e-mail institucional para entrar.");
    emailInput.focus();
    return false; // Para a execução da função e não segue para redirecionamento
  }

  // Se o email é válido, redireciona para a página inicial
  window.location.href = "./pagina-inicial/teladeinicio.html";
}


