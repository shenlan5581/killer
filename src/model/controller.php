#pragma once

#include <string>

namespace Model {

class Node;
class Manage{
 public:
    // action
    virtual  int Add(Parent,Node*)=0;
    virtual  int Delete(Node*)=0;
    virtual  int Save(Node*)=0;
    // make node
    virtual  Node *Create(string name,int FD)=0; 
    virtual  Node *Create(string Content,string name,int FD)=0; 
    //other
    virtual  Json *GetList(string Content,string name,int FD)=0; 
    virtual  int  *build(string path)=0; 

             int GetNode(Node*);
 protected:
    Node *current; 
    Node *root;
}

class drupal public Manage{
 public:
    virtual  int Add(Parent,Node*);
    virtual  int Delete(Node*);
    virtual  int Save(Node*);
    virtual  Node *Create(string name,int FD); 
    virtual  Node *Create(string Content,string name,int FD); 
             int GetNode(Node*);

}

class Node {
  protected:
    int   FD;
}

// leaf
class Content public Node {
  public:
    string GetCode();
  private:
    string code;
  protected:
    Node    *next_sibling;
}

class CTRL public Content {
  private:
    string code;
}

class Model public Content {
  private:
    string code;
}

// dir
class DIR_Node public Node {
  public:
  protected:
    string  FileName;
    Node    *next_chile;
    Node    *next_sibling;
}
// for drupal
class CtrlNode public DIR_Node{
  public:
  private:
     Node *	controller;
}
class ModelNode public DIR_Node{
  public:
  private:
	   Node * Model model;
}


}//namespace end


