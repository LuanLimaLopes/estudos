#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main() {
    char nome[100];
    float notas[4], media;
    FILE *aprovados, *recuperacao, *reprovados;

    aprovados = fopen("aprovados.txt", "a");
    recuperacao = fopen("recuperacao.txt", "a");
    reprovados = fopen("reprovados.txt", "a");

    if (!aprovados || !recuperacao || !reprovados) {
        printf("Erro ao abrir os arquivos.\n");
        return 1;
    }

    for (int i = 0; i < 10; i++) {
        printf("Informe o nome do aluno %d: ", i + 1);
        fgets(nome, sizeof(nome), stdin);

        nome[strcspn(nome, "\n")] = '\0';

        printf("Informe as 4 notas de %s:\n", nome);
        media = 0;

        for (int j = 0; j < 4; j++) {
            printf("Nota %d: ", j + 1);
            scanf("%f", &notas[j]);
            media += notas[j];
        }
        media /= 4;

        if (media >= 7.0) {
            printf("Aprovado!\n");
            fprintf(aprovados, "Nome: %s\nNotas: %.2f, %.2f, %.2f, %.2f\nMedia: %.2f\n\n", nome, notas[0], notas[1], notas[2], notas[3], media);
        } else if (media >= 5.0) {
            printf("Recuperação!\n");
            fprintf(recuperacao, "Nome: %s\nNotas: %.2f, %.2f, %.2f, %.2f\nMedia: %.2f\n\n", nome, notas[0], notas[1], notas[2], notas[3], media);
        } else {
            printf("Reprovado!\n");
            fprintf(reprovados, "Nome: %s\nNotas: %.2f, %.2f, %.2f, %.2f\nMedia: %.2f\n\n", nome, notas[0], notas[1], notas[2], notas[3], media);
        }

        getchar(); 
    }

    fclose(aprovados);
    fclose(recuperacao);
    fclose(reprovados);

    return 0;
}
