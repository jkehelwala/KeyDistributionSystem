CREATE USER 'basic'@'%' IDENTIFIED BY 'basic';
GRANT SELECT ON keydist.accounts TO 'basic'@'%' ;

CREATE USER 'machine'@'%' IDENTIFIED BY 'machine';
GRANT SELECT ON keydist.accounts TO 'machine'@'%' ;
GRANT SELECT, INSERT ON keydist.requests TO 'machine'@'%' ;

-- Todo