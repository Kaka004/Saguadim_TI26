document.getElementById("toggleCadastra").addEventListener("click", function () {
    document.getElementById("login").style.display = "none";
    document.getElementById("cadastra").style.display = "block";
  });
  
  document.getElementById("toggleLogin").addEventListener("click", function () {
    document.getElementById("cadastra").style.display = "none";
    document.getElementById("login").style.display = "block";
  });

  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm"); // Seletor do seu formulário
    const spinner = document.getElementById("loadingSpinner"); // Seletor do seu spinner
  
    form.addEventListener("submit", function (event) {
      event.preventDefault();
  
      // Adiciona a classe 'spinner' para mostrar o spinner
      spinner.classList.remove("hide");
  
      // Simula um tempo de espera antes de redirecionar (pode ser removido em produção)
      setTimeout(function () {
        // Redireciona para a página desejada
        window.location.href = "backoffice.php";
      }, 2000); // Tempo de espera em milissegundos (2 segundos neste exemplo)
    })
  });
  
  