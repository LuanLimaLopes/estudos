#include <stdlib.h>
#include <stdio.h>

int main(void)
{
	int op, n1, n2;
	int resu;
	int nome;
	int resposta;

	do
	{
		system("cls");
		printf("Escolha uma Alternativa\n");
		printf("\n 1 - Soma ");
		printf("\n 2 - Menos ");
		printf("\n 3 - Vezes ");
		printf("\n 4 - Dividir ");
		printf("\n 5 - Exercicio");
		printf("\n 6 - Login");
		printf("\n 7 - Esqueci minha senha");
		printf("\n -------------------");
		printf("\n 0 - Sair \n");

		scanf("%d", &op);
		switch (op)
		{
		case 0:
		{
			printf("---- SAIR ----");
			break;
		}

		case 1:
		{
			printf("\n informe o numero 1 \n");
			scanf("%d", &n1);
			printf("\n informa o numero 2 \n");
			scanf("%d", &n2);

			resu = n1 + n2;
			printf("Resultado: %d \n", resu);
			system("pause");
			break;
		}

		case 2:
		{
			printf("\n informe o numero 1 \n");
			scanf("%d", &n1);
			printf("\n informa o numero 2 \n");
			scanf("%d", &n2);

			resu = n1 - n2;
			printf("Resultado: %d \n", resu);
			system("pause");
			break;
		}

		case 3:
		{
			printf("informe o numero 1 \n");
			scanf("%d", &n1);
			printf("informa o numero 2 \n");
			scanf("%d", &n2);

			resu = n1 * n2;
			printf("Resultado: %d \n", resu);
			system("pause");
			break;
		}
		case 4:
		{
			printf("\n informe o numero 1 \n");
			scanf("%d", &n1);
			printf("\n informa o numero 2 \n");
			scanf("%d", &n2);

			resu = n1 / n2;
			printf("Resultado: %d \n", resu);
			system("pause");
			break;
		}
		case 5:
		{
			printf("\n qual o resultado de 5x5? \n");
			scanf("%d", &n1);
			if (n1 == 25)
			{
				printf("Resultado correto!  \n");
			}

			system("pause");
			break;
		}
		case 6:
		{
			printf("\n Usuario: \n");
			scanf("%d", &nome);
			if (nome == 123)
			{
				printf(" Login correto! \n");
			}
			else
			{
				printf(" login errado! \n");
			}
			system("pause");
			break;
		}
		case 7:
		{
			printf("\n Esqueceu sua senha?\n 1- Sim - 2 nao \n");
			scanf("%d", &resposta);
			if (resposta == 1)
			{
				printf("Se lascou kkkkkk \n");
			}
			else
			{
				if (resposta == 2)
				{
					printf("Entao ta de boa \n");
				}
			}
			system("pause");
			break;
		}
		default:
		{
			printf("alternativa incorreta! \n");
			system("pause");
			break;
		}
		}
	} while (op != 0);
	return 0;
}
