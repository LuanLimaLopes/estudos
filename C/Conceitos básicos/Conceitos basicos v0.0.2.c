#include<stdio.h>

main(){
	int numeros[4] = { 25,50,7,10};
	int i;
	char a;
	float b;
	double c;
	
	for (i = 0; i < 4; i++){
		printf("%d\n", numeros[i]);
	}
	
	for (i = 0; i < 4; i++){
		printf("%p\n", &numeros[i]);
	}
	
	printf("Int : %d \n", sizeof(i));
	printf("Char : %d \n", sizeof(a));
	printf("Float : %d \n", sizeof(b));
	printf("Double : %d \n", sizeof(c));
	printf("Vetor do tipo int com 4 posicoes = %d \n", sizeof(numeros));
	
}