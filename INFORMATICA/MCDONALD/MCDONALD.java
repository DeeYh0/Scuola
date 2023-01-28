import java.util.Scanner;

public class MCDONALD {
    public static void main(String[] args)
    {
        Scanner input = new Scanner(System.in);
        int utente;
        Elaborazione processing = new Elaborazione();
        
        // INIZIO PROGRAMMA
            System.out.println("BUON GIORNO, BENVENUTO A MCDONALD'S! SCEGLI COSA FARE:");
        do{
            System.out.println("[0]MENU' CLIENTE");
            System.out.println("[1]ACQUISTA PRODOTTO");
            System.out.println("[2]VISUALIZZA SCONTRINO");
            utente = input.nextInt();
            
            switch (utente) {
              case 0:
                processing.menu();
                break;

                case 1:
                processing.menu();
                processing.scelta();
                processing.scontrino();
                processing.pagamento();
                break;

                case 2:
                if(processing.prezzoFinale>0)
                {
                  processing.scontrino();
                }
                else
                {
                  System.out.println("\nNON HAI ACQUISTATO ANCORA NIENTE!\n");
                }
                break;
         }
      }while (utente != 4 && utente == 4);
  }
}

class Elaborazione
{
  int choose;
  int choose2;
  float scontrino = 0;
  int i;
  float prezzoFinale = 0;
  double resto;

  float[] prezzo = {4.5f, 1.0f, 4.7f, 2.6f, 2.5f};
  int[] magazziniere = {5, 4, 5, 2, 3};
  String[] menu = {"Bigmac", "Hamburger", "Crispy Mc Bacon", "My Selection BBQ", "Double Chicken BBQ"};
  int[] carrello = new int[10];

  void menu()
  {
      for (i = 0; i <= 4; i++)
      {
        carrello[i] = 0;
      }

      System.out.println("ECCO A LEI IL MENU': ");
      for (i = 0; i <= 4; i++)
      {
          System.out.print("["+i+"]"+menu[i]+" = "+magazziniere[i]+" ------> "+ prezzo[i]+" Euro\n");
      }
  }

  void scelta()
  {
    Scanner scan = new Scanner(System.in);
      do {
        System.out.println("COSA INTENDE MANGIARE?");
        choose = scan.nextInt();
          magazziniere[choose] = magazziniere[choose] - 1;
          carrello[choose] = carrello[choose] + 1;
          System.out.println("VUOI AGGIUNGERE ALTRO?");
          System.out.println("[0]CONTINUA A SCEGLIERE");
          System.out.println("[1]PROCEDI CON L'ORDINE");
          choose2 = scan.nextInt();
      }while (choose2 == 0);
  }
    
    void scontrino()
    {
      System.out.println("IL SUO SCONTRINO E': ");
      for (i = 0; i <= 4; i++)
      {
          if (carrello[i] > 0)
          {
              scontrino = scontrino + prezzo[i] * carrello[i];
              System.out.print("x"+carrello[i]+" "+menu[i]+" = "+prezzo[i]+" Euro\n");
          }
      }
          prezzoFinale = prezzoFinale + scontrino;
    
      System.out.print("IL PREZZO TOTALE DEL TUO ORDINE E' "+scontrino+" EURO\n\n");
    }   

    void pagamento()
    {
      Scanner scan = new Scanner(System.in);
      System.out.println("COME VUOLE PAGARE?\n" + "[0]CARTA\n" + "[1]CONTANTI");
      choose = scan.nextInt();

      if(choose == 0)
      {
        System.out.println("PASSI LA CARTA...\n"+ "ELABORAZIONE IN CORSO DEL PAGAMENTO...\n"+"FATTO!\n" +
        "\nHO PRELEVATO PRECISAMENTE "+prezzoFinale + " euro!\n"+ "GRAZIE E ALLA PROSSIMA!");
      }
      else if(choose == 1)
      {
        System.out.println("SONO PRECISAMENTE "+prezzoFinale+" euro\n");

        do {
        System.out.println("CON QUANTO PAGA?");
        resto = scan.nextDouble();

        if(resto < prezzoFinale)
        {
          System.out.println("QUESTI SOLDI NON SONO SUFFICIENTI!\n"+"REINSERISCI UNA QUOTA ADEGUATA!\n"); 
        }
      } while (resto < prezzoFinale);
      
        resto = resto - prezzoFinale;

        //La variabile roundOff arrotonda il resto a 1 cifra decimale
        double roundOff = Math.round(resto * 100.0) / 100.0;

        System.out.println("\nECCO A LEI IL RESTO DI "+ roundOff+" euro\n"+ "GRAZIE E ALLA PROSSIMA!"); 
      }
      
    }
}


