#include <stdio.h>

main(void)
{
    char tipoComb;
    float qtdeLitros, valorPagar;

    printf("informe o tipo do combustivel A/G: \n");
    scanf("%c", &tipoComb);

    printf("informe a quantidade de litros: \n");
    scanf("%f", &qtdeLitros);
    if ((tipoComb != 'A') && (tipoComb != 'G'))
    {
        printf("Combustivel invalido !");
    }
    else
    {
        if (tipoComb == 'A')
        {
            if (qtdeLitros <= 20)
            {
                valorPagar = (qtdeLitros * 3.49) * 0.97;
            }
            else
            {
                valorPagar = (qtdeLitros * 3.49) * 0.95;
            }
        }
        else
        {
            if (qtdeLitros <= 20)
            {
                valorPagar = (qtdeLitros * 5.49) * 0.96;
            }
            else
            {
                valorPagar = (qtdeLitros * 5.49) * 0.94;
            }
        }
    }
    printf("valor a pagar e : %f", valorPagar);
    return 0;
}