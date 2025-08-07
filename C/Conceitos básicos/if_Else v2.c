#include<stdio.h>

float calcularParcela(){
	float parcela,juros,reajuste,empress,parc;
	
	printf("Qual o valor emprestimo?  ");
	scanf("%f", &empress);
	printf("Quantas parcelas deseja?  ");
	scanf("%f", &parc);
	
	juros = empress * 0.2;
	reajuste = juros + empress;
	parcela = reajuste / parc;
	
	return parcela;
}

int main(){
	float p, aprova, renda;
	p = calcularParcela();
	
	printf("Qual sua renda mensal?   ");
	scanf("%f", &renda);	
	
	aprova = renda * 0.3;
	
	if (aprova <= p){
		printf(" Seu emprestimo foi recusado!");
		printf("\n Sua parcela ficou R$%.2f.", p);
	} else {
		printf(" Seu emprestimo foi aprovado!");
		printf("\n Sua parcela ficou R$%.2f", p);
	}
	return 0;
}