#include<stdio.h>
main(){
	int n1, n2;
	int *p1, *p2, *tempi;
	
	p1 = &n1;
	p2 = &n2;
	
	printf(" Antes da inversao. \n\n %p  e  %p", p1,p2 );
	
	tempi = p1;
	p1 = p2;
	p2 = tempi;
	
	printf("\n\n Depois da inversao. \n\n %p  e  %p", p1,p2 );
}