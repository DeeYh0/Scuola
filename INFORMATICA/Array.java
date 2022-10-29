import java.text.ParsePosition;
import java.util.*;

//Scrivi un programma che, dopo aver riempito casualmente un vettore con
//numeri dispari di due cifre, li modifica alternando a un numero dispari un
//numero pari ottenuto come somma dell’elemento corrente e dell’elemento di posizione precedente.

public class Array
{
    public static void main(String[] args)
    {
        int max = 99;
        int min = 10;

        int oddNumber[] = new int[10];
        Random r = new Random();

        for(int i=0; i < 10; i++)
        {
           int randomNumber = r.nextInt(max-min)+min;
            
            if (randomNumber%2 == 0) //Se il resto della divisione del numero casuale è 0, incrementa il numero casuale di 1 così diventa dispari
            {
                randomNumber = randomNumber + 1;
            }

            if (i%2 != 0) //Se il resto della divisione del numero casuale è diverso da 0, aggiungi all'array i numeri casuali
            {
                oddNumber[i] = randomNumber;
                
            }

            else 
            {
                oddNumber[i] = oddNumber[i - 1] + randomNumber;
            }
           
        }

        //Stampa 10 numeri dispari
        for(int i=0; i < 10; i++)
        {
            System.out.println(oddNumber[i]);
        }
        
    }
}

