
#include <stdio.h>
int valor;
int main(void)
{
    printf("Digite um numero de 1 a 5\n");
    scanf("%d", &valor);
    switch (valor)
    {
    case 1:
        printf("miau");
        break;
    case 2:
        printf("auau");
        break;
    case 3:
        printf("Ruff ruff");
        break;
    case 4:
        printf("piu piu");
        break;
    case 5:
        printf("MUUUUU");
        break;
    }
    return 0;
}