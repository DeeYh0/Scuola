package com.deeyh.studiodentistico;

import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Label;
import javafx.scene.control.MenuBar;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.paint.Color;
import javafx.stage.FileChooser;
import javafx.stage.Stage;

import java.io.*;
import java.lang.reflect.Array;
import java.util.ArrayList;
import java.util.Scanner;

 class Pazienti {
    public String name;
    public String surname;
    public String age;
    public String cf;
    public String sintomi;
    public String residenza;

    public Pazienti(String name, String surname, String age, String cf, String residenza, String sintomi)
    {
        this.name = name;
        this.surname = surname;
        this.age = age;
        this.cf = cf;
        this.residenza = residenza;
        this.sintomi = sintomi;
    }

    public String returnNome()
    {
        return name;
    }
     public String returnCognome()
     {
         return surname;
     }
     public String returneta()
     {
         return age;
     }
     public String returncf()
     {
         return cf;
     }
     public String returnresidenza()
     {
         return residenza;
     }
     public String returnsintomi()
     {
         return sintomi;
     }
 }

class SaveFile {
    FileWriter fileWriter = new FileWriter("FILE_PAZIENTI.txt", true);
    BufferedWriter buffered = new BufferedWriter(fileWriter);

    public boolean registraPaziente(ArrayList<Pazienti> pazienti) {
        try {
            for (Pazienti p : pazienti) {
                buffered.write(p.name + "\n" + p.surname + "\n" + p.age + "\n" + p.residenza + "\n" + p.cf + "\n" + p.sintomi + "\n");
            }
            buffered.close();
        } catch (IOException e) {
            System.out.println("ERROR 104");
            return false;
        }
        return true;
    }

    SaveFile() throws IOException {
    }
}



public class StudioController {
    ArrayList<Pazienti> patients = new ArrayList<>();
    public Label confirm;
    @FXML
    private TextField name, surname, age, cf, residenza, sintomi;
    private TextArea printPatient;
    private Stage PazientiStage;
    private Scene PazientiScene;
    private Parent root;
    @FXML
    private MenuBar menubar;

    public void close()
    {
        System.exit(0);
    }

    public void about() {
        try {
            root = FXMLLoader.load(getClass().getResource("About.fxml"));
            PazientiStage = (Stage)menubar.getScene().getWindow();
            PazientiStage.setTitle("About us");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void home() throws IOException {
        try {
            root = FXMLLoader.load(getClass().getResource("Studio-view.fxml"));
            PazientiStage = (Stage)menubar.getScene().getWindow();
            PazientiStage.setTitle("Studio Dentistico");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void registra(ActionEvent ev) throws IOException {
        try {
            root = FXMLLoader.load(getClass().getResource("Registra.fxml"));
            PazientiStage = (Stage)menubar.getScene().getWindow();
            PazientiStage.setTitle("Registra Pazienti");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    public void visualizza() throws IOException {
        try {
            root = FXMLLoader.load(getClass().getResource("Visualizza.fxml"));
            PazientiStage = (Stage)menubar.getScene().getWindow();
            PazientiStage.setTitle("Visualizza Pazienti");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    public void gestione() throws IOException {
        try {
            root = FXMLLoader.load(getClass().getResource("Gestione.fxml"));
            PazientiStage = (Stage)menubar.getScene().getWindow();
            PazientiStage.setTitle("Gestione Pazienti");
            PazientiScene = new Scene(root);
            PazientiStage.setScene(PazientiScene);
            PazientiStage.show();
            PazientiStage.setResizable(false);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private boolean isNumber(String number) {
        try {
            Integer.parseInt(number);
            return true;
        } catch (NumberFormatException e) {
            return false;
        }
    }

    public void submit() throws IOException {
        ArrayList<Pazienti> pazientiList = new ArrayList<>();
        SaveFile save = new SaveFile();

        if (isNumber(age.getText())) {
            confirm.setText("Paziente Registrato");
            confirm.setTextFill(Color.GREEN);

            pazientiList.add(new Pazienti("Nome: "+name.getText(),"Cognome: "+surname.getText(),"Età: "+age.getText(),"Residenza: "+residenza.getText(),"Codice Fiscale: "+cf.getText(),"Sintomi: "+sintomi.getText() + "\n"));
            save.registraPaziente(pazientiList);
        } else {
            confirm.setText("ETA' NON VALIDA");
            confirm.setTextFill(Color.RED);
        }
        resetField();
        viewPatient();
    }

    @FXML
    public void viewPatient() throws IOException {
        BufferedReader reader = new BufferedReader(new FileReader("FILE_PAZIENTI.txt"));
        String line = reader.readLine();
        while (line != null) {
            System.out.println(line);
            line = reader.readLine();
        }
        }

    @FXML
    public void resetField() {
        name.setText("");
        surname.setText("");
        age.setText("");
        cf.setText("");
        residenza.setText("");
        sintomi.setText("");
    }


}
