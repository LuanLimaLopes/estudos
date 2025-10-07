const form = document.getElementById('form-imc');

form.addEventListener('submit', function (event) {
    event.preventDefault();

    const peso = parseFloat(document.getElementById('peso').value);
    const altura = parseFloat(document.getElementById('altura').value);

    const imc = peso / (altura * altura);

    let classificacao;

    if (imc < 18.5) {
        classificacao = "Abaixo do peso";
    } else if (imc < 25) {
        classificacao = "Peso normal";
    } else if (imc < 30) {
        classificacao = "Sobrepeso";
    } else if (imc < 35) {
        classificacao = "Obesidade grau 1";
    } else if (imc < 40) {
        classificacao = "Obesidade grau 2";
    } else {
        classificacao = "Obesidade grau 3";
    }

    console.log('Peso:', peso);
    console.log('Altura:', altura);
    console.log('IMC:', imc.toFixed(2));

    alert(`Seu IMC é: ${imc.toFixed(2)} - ${classificacao}`)
})