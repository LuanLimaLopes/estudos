#include <stdio.h>
#include <locale.h>

main(void)
{
    setlocale(LC_ALL, "Portuguese");
    int l1, l2, l3;

    printf("informe o lado 1:");
    scanf("%d", &l1);

    printf("informe o lado 2:");
    scanf("%d", &l2);

    printf("informe o lado 3:");
    scanf("%d", &l3);

    if ((l1 > l2 + l3) || (l2 > l1 + l3) || (l3 > l1 + l2))
    {
        printf("Os lados informados não formam um triangulo");
    }
    else
    {
        if ((l1 == l2) && (l1 == l3))
        {
            printf("triangulo equilatero");
        }
        else
        {
            if ((l1 != l2) && (l1 != l3))
            {
                printf("triangulo escaleno");
            }
            else
            {
                printf("triangulo isosceles!");
            }
        }
    }
    return 0;
}