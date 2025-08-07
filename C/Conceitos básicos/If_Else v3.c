#include<stdio.h>


main(){
	FILE *arquivo;
	arquivo = fopen("dados.txt", "a");
	
	float temp[100], menor, maior,media = 0;
	int inferior = 0;
	for(int i = 0; i < 7; i++){
		do {
			printf("Qual foi a temperatura do dia %d ? ", i + 1);
			scanf("%f", &temp[i]);
		} while ((temp[i] <= -95) || (temp[i] >= 65));
		
		if (!maior || maior < temp[i]){
			maior = temp[i];
		}
		if (!menor || menor > temp[i]){
			menor = temp[i];
		}
		
		media = media + temp[i];
		
	}
	
	media = media / 7;
	
	for(int i = 0; i < 7; i++){
		if(media > temp[i]){
			inferior = inferior + 1;
		}
	}
	
	printf(" A maior temperatura foi %.f", maior);
	printf("\n A menor temperatura foi %.f", menor);
	printf("\n A media da tempetura foi %.f", media);
	printf("\n Foram %d dias abaixo da media.", inferior);
	
	fprintf(arquivo, "\n\nMaior temp: %.f", maior);
	fprintf(arquivo, "\nMenor temp: %.f", menor);
	fprintf(arquivo, "\nMedia temp: %.f", media);
	fprintf(arquivo, "\nDias Abaixo: %d\n", inferior);
	
	fclose(arquivo);
	
}	