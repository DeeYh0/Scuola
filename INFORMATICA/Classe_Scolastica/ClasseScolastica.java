import java.util.ArrayList;
import java.util.Scanner;

public class ClasseScolastica {
    public static void main(String[] args) {

        ArrayList<Studente> classe = new ArrayList<>();
        Scanner input = new Scanner(System.in);

        while (true) {
            System.out.println("\nMenu:");
            System.out.println("1. Inserisci anagrafica studente");
            System.out.println("2. Stampa classe");
            System.out.println("3. Ricerca per nome e cognome");
            System.out.println("4. Esci");
            System.out.print("Scelta: \n");

            int scelta = input.nextInt();
            input.nextLine();

            switch (scelta) {
                case 1:
                    System.out.print("Inserisci nome: ");
                    String nome = input.nextLine();

                    System.out.print("Inserisci cognome: ");
                    String cognome = input.nextLine();

                    System.out.print("Inserisci età: ");
                    int eta = input.nextInt();
                    
                    classe.add(new Studente(nome, cognome, eta));
                    break;

                case 2:
                    System.out.println("\nElenco studenti: \n");
                    if (classe.isEmpty()) {
                        System.out.println("Non ci sono studenti registrati al momento!\n");
                    } else {
                        for (Studente studente : classe) {
                            System.out.println(studente + "\n");
                        }
                    }
                    break;

                case 3:
                    System.out.print("\nInserisci nome da cercare: ");
                    String nomeDaCercare = input.nextLine();
                    System.out.print("Inserisci cognome da cercare: ");
                    String cognomeDaCercare = input.nextLine();

                    boolean trovato = false;
                    for (Studente studente : classe) {
                        if (studente.nome().equals(nomeDaCercare) && studente.cognome().equals(cognomeDaCercare)) {
                            System.out.println("\nStudente trovato: " + studente + "\n");
                            trovato = true;
                            break;
                        }
                    }

                    if (!trovato) {
                        System.out.println("\nStudente non trovato.\n");
                    }
                    break;

                case 4:
                    System.out.println("\nUscita dal programma.\n");
                    System.exit(0);
                    break;

                default:
                    System.out.println("Scelta non valida. Riprova.");
                    break;
            }
        }
    }
}
