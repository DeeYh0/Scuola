package com.deeyh.passwordmanage;

import java.awt.EventQueue;
import java.awt.Font;
import java.io.File;
import java.io.FileNotFoundException;
import java.util.Scanner;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JScrollPane;
import javax.swing.JPanel;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.BorderLayout;
import javax.swing.SpringLayout;
import javax.swing.GroupLayout;
import javax.swing.GroupLayout.Alignment;
import java.awt.FlowLayout;
import javax.swing.BoxLayout;
import com.jgoodies.forms.layout.FormLayout;
import com.jgoodies.forms.layout.ColumnSpec;
import com.jgoodies.forms.layout.RowSpec;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class ViewPass {

	public JFrame frame;

	/**
	 * Launch the application.
	 */


	/**
	 * Create the application.
	 */
	public ViewPass() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	public void readPasswords(JPanel p) {
		try {
			  File myObj = new File("password.txt");
			  Scanner myReader = new Scanner(myObj);
			  while (myReader.hasNextLine()) {
			    String data = myReader.nextLine();
			    JLabel btn = new JLabel(data);
			    btn.setFont(new Font("Microsoft YaHei", Font.PLAIN, 20));
			    p.add(btn);
			  }
			  myReader.close();
	    } catch (FileNotFoundException e) {
		      System.out.println("An error occurred.");
		      e.printStackTrace();
	    }
	}
	private void initialize() {		
		frame = new JFrame();
		frame.setBounds(100, 100, 623, 441);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		JLabel lblNewLabel = new JLabel("VIEW PASSWORD");
		lblNewLabel.setFont(new Font("Century", Font.PLAIN, 40));
		lblNewLabel.setBounds(128, 1, 408, 80);
		frame.getContentPane().add(lblNewLabel);
		
		JScrollPane scrollPane = new JScrollPane();
		scrollPane.setBounds(0, 74, 607, 271);
		frame.getContentPane().add(scrollPane);
		
		JPanel panel = new JPanel();
		scrollPane.setViewportView(panel);
		readPasswords(panel);
		panel.setLayout(new BoxLayout(panel, BoxLayout.Y_AXIS));
		
		JButton btnNewButton = new JButton("EXIT");
		btnNewButton.addMouseListener(new MouseAdapter() {
			@Override
			public void mouseClicked(MouseEvent e) {
				System.exit(0);
			}
		});
		btnNewButton.setFont(new Font("Microsoft YaHei", Font.PLAIN, 20));
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
			}
		});
		btnNewButton.setBounds(495, 354, 102, 37);
		frame.getContentPane().add(btnNewButton);
		
	}
}
