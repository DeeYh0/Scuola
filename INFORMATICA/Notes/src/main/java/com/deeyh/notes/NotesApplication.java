package com.deeyh.notes;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Scene;
import javafx.scene.image.Image;
import javafx.stage.Stage;

import java.io.IOException;

public class NotesApplication extends Application {
    @Override
    public void start(Stage stage) throws IOException {
        FXMLLoader fxmlLoader = new FXMLLoader(NotesApplication.class.getResource("Notes-view.fxml"));

        Scene scene = new Scene(fxmlLoader.load(), 1000, 550);
        Image image = new Image(NotesApplication.class.getResource("icon.png").openStream());
        stage.getIcons().add(image);
        stage.setResizable(false);
        stage.setTitle("Notes");
        stage.setScene(scene);
        stage.show();
    }

    public static void main(String[] args) {
        launch();
    }
}