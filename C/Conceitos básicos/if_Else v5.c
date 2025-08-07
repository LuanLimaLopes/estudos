#include<stdio.h>
#include<stdlib.h>
#include<string.h>

float id_dias(float n1, float n2, float n3){
	float ano,meses;

	ano = n1 * 365,25;
	meses = n2 * 30;

	return (n3 + meses + ano);
}

float peso_ideal(int sexo, float alt,float peso){
	
		if(sexo == 'h'){
			peso = 72.7 * alt - 58;
		} 
		else if(sexo == 'm'){
			peso = 62.1 * alt - 44.7;
		}
		
	printf("seu peso ideal e %1.f", peso);
	
	return 0;
}

float media_arit(int num){
	float total = 0, media;
	char letra;
	float n1,n2;
	
	if((letra == 'a') || (letra == 'A')){
	for(int i = 0; i < num; i++){
		printf("Digite o numero media arit %d :", i + 1);
		scanf("%f", &media);
		
		total = total + media;
		}
	total = total / num;
	} else if((letra == 'p') || (letra == 'P')){
		printf("Diga o valor de n1 : \n");
		scanf("%f", &n1 );
		printf("Diga o valor de n2 : \n");
		scanf("%f", &n2 );

		n1 = n1 * 7;
		n2 = n2 * 3;
	
	}
	return total;
}







int main(void){
	int op;
	printf("Escolhe : \n");
	printf("1 - Anos em dias \n");
	printf("2 - Peso ideal conforme a altura \n");
	printf("3 - Media aritmedia ou ponderada \n");
	scanf("%d", &op);
	
	switch(op){
		case 1:{
			float n1, n2, n3, anos_terra;
			
			printf("Informe quantos anos ? \n");
			scanf("%f", &n1);
			printf("informe os meses atual ? \n");
			scanf("%f", &n2);
			printf("informe os dias atuais ? \n");
			scanf("%f", &n3);
			
			anos_terra = id_dias(n1,n2,n3);
			
			printf("Voce tem %1.f dias na terra! \n", anos_terra);
			
			break;
		}
		
		case 2:{
			float alt,peso;
			char sexo;
			
			do{
				printf("qual seu genero? (h/m)");
				scanf("%s", &sexo);
			if((sexo == 'h') || (sexo == 'm')){
					break;
				}
			printf("opcao incorreta! \n");
			}while(true);
			
			printf("Quanto de altura voce tem? \n");
			scanf("%f", &alt);
			
			peso_ideal(sexo,alt,peso);
			break;
		}
		case 3:{
			int num;
			
		float resultado;
	
			printf("Quantos numeros serao? \n");
			scanf("%d", &num);
			
			resultado = media_arit(num);
			
			printf("A media dos valores e %.1f", resultado);
			break;
		}
		case 4:{
			
			break;
		}
		case 5:{
			
			break;
		}
		case 6:{
			
			break;
		}
	}
	return 0;
}

