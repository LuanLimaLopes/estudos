#include <stdio.h>

main(void)
{

    int conceito, aluno, media;
    float n1, n2, n3, n4;
    printf("Qual seu RA?");
    scanf("%d", &aluno);

    printf("diga sua primeira nota:");
    scanf("%f", &n1);

    printf("diga sua segunda nota:");
    scanf("%f", &n2);

    printf("diga sua terceira nota:");
    scanf("%f", &n3);

    printf("diga sua quarta nota:");
    scanf("%f", &n4);

    media = (n1 + n2 + n3 + n4) / 4;

    if ((media >= 9) and (media <= 10))
    {
        printf("Aluno %d aprovado com conceito A", aluno);
    }
    else
    {
        if ((media >= 7.5) and (media <= 8.5))
        {
            printf("Aluno %d Aprovado com conceito B", aluno);
        }
        else
        {
            if ((media >= 6.0) and (media <= 7.4))
            {
                printf("Aluno %d aprovado com conceito C", aluno);
            }
            else
            {
                if ((media >= 4.0) and (media <= 5.9))
                {
                    printf("Aluno %d reprovado com conceito D", aluno);
                }
                else
                {
                    if ((media >= 0) and (media <= 3.9))
                    {
                        printf("Aluno %d reprovado com conceito E", aluno);
                    }
                }
            }
        }
    }
    return 0;
}