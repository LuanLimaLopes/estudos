#include <stdio.h>
#include <locale.h>

int main(void)
{
    setlocale(LC_ALL, "Portuguese");

    int falta;
    float media;

    printf("informe a quantidade de faltas: \n");
    scanf("%d", &falta);

    printf("Informe a sua media: \n");
    scanf("%f", &media);

    if (falta > 25)
    {
        printf("reprovado por faltas!");
    }
    else
    {
        if (media >= 6)
        {
            printf("aprovado!");
        }
        else
        {
            if ((media >= 5) or(media == 5.9))
            {
                printf("Recuperacao!");
            }
            else
            {
                printf("reprovado por media!");
            }
        }
    }
    return 0;
}