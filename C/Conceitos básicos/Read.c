#include<stdio.h>
#include<stdlib.h>

main(void){
	FILE *arquivo;
	char frase[100];
	
	arquivo = fopen("teste3.txt", "a");
	
	if (arquivo == NULL) {
		printf("Houve um erro ao abrir o arquivo.\n");
		exit(0)
	}
	 printf("digite a frase a ser gravada no arquivo : \n");
	 fflush(stdin);
	 gets(frase);
	 fprintf(arquivo, "%s", frase);
	 fprintf(arquivo, "\n");
	 
	 fclose(arquivo);
	 
}