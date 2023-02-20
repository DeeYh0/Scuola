package com.deeyh.passwordmanage;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;

public class Manager {

	public String manager(String site, String password) {
	    try {
	        File file = new File("password.txt");
	        FileWriter writer = new FileWriter(file, true);
	        writer.write("\nSito: " + site + "\n");
	        writer.write("Password: " + password + "\n");
	        writer.write("----------------------------\n");
	        writer.close();
	        return "PASSWORD AGGIUNTA";
	    } catch (IOException e) {
	        return "Error 104";
	    }
	}

}
