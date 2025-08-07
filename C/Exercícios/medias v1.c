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

	if ((falta <= 25) and(media >= 6))
	{
		printf("Aprovado");
	}
	else
	{
		printf("Reprovado!");
	}

	return 0;
}
