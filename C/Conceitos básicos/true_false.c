/*
    Entrada de dados, processamento, saida de dados// <- texto
    Operadores relacionais == ,<> ,< ,<= ,> ,>= ,!= .
    Operadores lógicos And,or // || = or && = and

    !	And só retorna o falso
    (Se os dois forem verdadeiro ele retorna verdadeiro)

        if (and == verdadeiro) and (não == falso)

    !	Or retorna o verdadeiro
    (Se um dos dois for verdadeiro ele retorna o verdadeiro)

        If(or == verdadeiro) or (não = falso)
*/

#include <stdio.h>
#include <locale.h>

int main(void)
{
    setlocale(LC_ALL, "Portuguese");

    int idade;

    printf("informe sua idade: \n");
    scanf("%d", &idade);

    if ((idade <= 10) or(idade >= 60))
    {
        printf("pode vacinar!");
    }
    else
    {
        printf("Não pode vacinar!");
    }

    return 0;
}