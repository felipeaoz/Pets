#include <stdio.h>
#include <math.h>
#include <stdlib.h>
int main()

{
 float lado;
 float base;
 int cant;
 float S;
 float xi;
 int j;

 printf("a = ");
 scanf("%f", &lado);
 printf("b = ");
 scanf("%f", &base);
 printf("Número = ");
 scanf("%i", &cant);

 S = 0;
 for(j = 0; j<cant; j++)
 {
   xi = 0.5*(j*(base-lado)/cant + (j+1)*(base-lado)/cant);
   S = S + (base-lado)/cant*sin(xi);
 }

 printf("RESULTADO: ");
 printf("%f", S);
 printf("\n");

}