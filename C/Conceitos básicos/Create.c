#include<stdio.h>
#include<stdlib.h>

main(){
	FILE *arquivo; // declaração de arquivo
	
	arquivo = fopen("teste.txt", "w");
	
	if(arquivo == NULL){
		printf("Houve um erro ao abrir o arquivo.\n");
		exit(0);
	} else {
		printf("Arquivo teste.txt criado com sucesso!\n");
	}
	fclose(arquivo);
	
}