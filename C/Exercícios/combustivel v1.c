#include <stdio.h>

main(void)
{

    int valor;
    int tipo;
    int combustivel;

    printf("quantos combustivel quer? \n");
    scanf("%d", &combustivel);
    printf("G-gasolina ou A-alcool? \n");
    scanf("%d", &tipo);

    if (tipo = 'G')
    {
        valor = combustivel * 5.49;
        printf("%d", valor);
    }
    else
    {
        if (tipo = 'A')
        {
            valor = combustivel * 3.49;
            printf("%d", valor);
        }
    }
    return 0;
}