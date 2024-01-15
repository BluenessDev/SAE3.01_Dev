# Chargement des packages
library(shiny)
library(dplyr)
library(ggplot2)

# Lecture du fichier CSV et conversion de la colonne "date_creation" en classe "Date"
tickets <- read.csv("tickets.csv", header = TRUE)
tickets$date_creation <- as.Date(tickets$date_creation)

# Définition de l'interface utilisateur (UI)
ui <- fluidPage(
  titlePanel("Analyse des tickets créés"),
  sidebarLayout(
    sidebarPanel(
      selectInput("annee", "Choisir une année", choices = sort(unique(format(tickets$date_creation, "%Y")))),
      selectInput("mois", "Choisir un mois", choices = c("Tous", sort(unique(format(tickets$date_creation, "%m")))))
    ),
    mainPanel(
      plotOutput("diagramme"),
      textOutput("resultat")
    )
  )
)

# Définition de la logique du serveur
server <- function(input, output) {
  output$diagramme <- renderPlot({
    if(input$mois == "Tous") {
      tickets_par_mois <- tickets %>%
        filter(substring(date_creation, 1, 4) == input$annee) %>%
        group_by(mois = format(date_creation, "%m")) %>%
        summarise(nombre_de_tickets = n())
      
      tickets_par_mois$mois <- factor(tickets_par_mois$mois, levels = unique(tickets_par_mois$mois))
      
      ggplot(tickets_par_mois, aes(x = mois, y = nombre_de_tickets, fill = mois)) +
        geom_bar(stat = "identity") +
        labs(title = paste("Répartition des tickets par mois en", input$annee), fill = "Mois") +
        theme_minimal()
    }
  })
  
  output$resultat <- renderText({
    if(input$mois != "Tous") {
      tickets_filtres <- tickets %>%
        filter(substring(date_creation, 1, 4) == input$annee, format(date_creation, "%m") == input$mois)
      paste("Nombre de tickets créés ce mois-ci :", nrow(tickets_filtres))
    }
  })
}

# Lancement de l'application
shinyApp(ui = ui, server = server)