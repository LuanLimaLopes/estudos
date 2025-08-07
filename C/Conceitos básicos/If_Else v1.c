#include<stdio.h>

main(){
	float ana = 1.50, felis = 1.10; 
	int calculo = 0;

	do {
		calculo = calculo + 1;
		ana = ana + 0.02;
		felis = felis + 0.03;
		
	} while (felis < ana);
	
	if(felis > ana){
		printf("Felisberto e maior que ana depois de %d anos. ", calculo);
	}
	
}