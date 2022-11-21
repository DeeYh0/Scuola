import java.util.Scanner;

public class TestLampadina { 

    public static void main(String[] args) {

        Scanner scan = new Scanner(System.in);
        int totClick;
        int choose = 0;
        
        System.out.println("INSERISCI IL NUMERO MASSIMO DI CLICK");
        totClick = scan.nextInt();

        Lampadina lamp = new Lampadina(totClick);

        do
        {
            System.out.println("\nSCEGLI COSA FARE:");
            System.out.println("[0]VISUALIZZA LO STATO DELLA LAMPADINA");
            System.out.println("[1]ACCENDI O SPEGNI LA LAMPADINA");
            System.out.println("[2]ESCI\n");
            choose = scan.nextInt();

            switch (choose)
            {
                case 0:
                    System.out.println("\n"+lamp.stato());
                break;
                 
                case 1:
                    lamp.click();
                break;

                default:
                    break;
            }

        } while(choose != 2);
        
        
    }
}

class Lampadina
{
    int Click;
    int totClick;
    int j; //conta quante volte è stata accesa/spenta la lampadina
    
    public Lampadina (int totClick)
    {
        this.totClick = totClick;
    }

    void click()
    {
        if(j >= this.totClick)
        {
            Click = 2;
        }
        else if(Click == 1)
        {
           Click = 0;
           j++;
        }
        else if(Click == 0)
        {
            Click = 1;
            j++;
        }
    }

    String stato()
    {
        if(Click == 1)
        {
            return "LA LAMPADINA E' ACCESA";
        }
        else if(Click == 0)
        {
            return "LA LAMPADINA E' SPENTA";
        }
        else if(Click == 2)
        {
            return "LA LAMPADINA SI E' ROTTA";
        }
        return null;
    }
}
    