
    const senhaInput = document.getElementById("senha");
    const showPasswordButton = document.getElementById("showPassword");

    showPasswordButton.addEventListener("click", () => {
        if (senhaInput.type === "password") {
            senhaInput.type = "text"; // Mostra a senha
            showPasswordButton.innerHTML = '<i class="bi bi-eye-slash"></i>'; // Troca o ícone para um "olho riscado"
        } else {
            senhaInput.type = "password"; // Oculta a senha
            showPasswordButton.innerHTML = '<i class="bi bi-eye"></i>'; // Volta para o ícone normal "olho"
        }
    });


    document.addEventListener("DOMContentLoaded", function () {
        const senhaInput = document.getElementById("senha");
        const confirmSenhaInput = document.getElementById("confirm_senha");

        const form = document.querySelector("form"); // Selecione o formulário

        form.addEventListener("submit", function (event) {
            if (senhaInput.value !== confirmSenhaInput.value) {
                event.preventDefault(); // Impede o envio do formulário
                alert("A senha e a confirmação de senha não coincidem. Por favor, verifique.");
            }
        });
    });



